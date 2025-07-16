<?php

namespace App\Http\Controllers;

use App\Models\HomeBookService;
use App\Models\ServiceHome;
use App\Models\StaffHome;
use Illuminate\Http\Request;
use App\Models\ServiceGroupHome;
use Carbon\Carbon;
use App\Models\StaffWorkingHour;
use Illuminate\Support\Facades\Auth;



// To Payment & SMS
use Illuminate\Support\Facades\Http;


class HomeBookingController extends Controller
{

    public function getAvailableTimes($date, $staffId)
    {
        // 1. جلب دوام الموظف (افترض جدول staff_working_hours يحتوي start_time و end_time كـ TIME)
        $workingHours = StaffWorkingHour::where('staff_id', $staffId)->first();

        if (!$workingHours) {
            return response()->json([]);
        }

        $start = Carbon::createFromFormat('H:i:s', $workingHours->start_time);
        $end = Carbon::createFromFormat('H:i:s', $workingHours->end_time);

        // 2. جلب أوقات الحجز الموجودة لذلك الموظف والتاريخ
        $bookedTimes = HomeBookService::where('staff_id', $staffId)
            ->where('date', $date)
            ->pluck('time') // تفترض أن الوقت مخزن كـ 'H:i:s' أو 'H:i'
            ->toArray();

        // 3. توليد الفترات الزمنية بفاصل ساعة
        $availableTimes = [];
        $current = $start->copy();

        while ($current->lt($end)) {
            $timeStr = $current->format('H:i');

            // 4. التحقق اذا الوقت محجوز
            if (!in_array($timeStr, $bookedTimes)) {
                $availableTimes[] = $timeStr;
            }

            // نزيد ساعة
            $current->addHour();
        }

        return response()->json($availableTimes);
    }

    public function index()
    {
        return response()->json(StaffHome::all());
    }

    public function getServiceGroups($gender)
    {
        $groups = ServiceGroupHome::where('gender', $gender)->get();

        return response()->json($groups);
    }

    public function getServicesByGroup($serviceGroupId)
    {
        $services = ServiceHome::where('service_group_homes_id', $serviceGroupId)->get();

        return response()->json($services);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'customer_name'     => 'required|string|max:255',
            'mobile_no'         => 'required|string|max:20',
            'neighborhood'      => 'required|string|max:255',
            'gender'            => 'required|in:men,women',
            'service_group_id'  => 'required|exists:service_group_homes,id',
            'service_id'        => 'required|exists:service_homes,id',
            'date'              => 'required|date',
            'time'              => 'required|string',
            'branch'              => 'required|string',
            'staff_id'          => 'required|exists:staff_homes,id',
        ]);

        $data['type'] = 'home';

        HomeBookService::create($data);

        return response()->json(['message' => 'Booking saved successfully']);
    }




    //        Payment Methods

    public function createPayment(Request $request)
    {
        
        $amount = $request->query('am');
    
        if (!$amount || !is_numeric($amount)) {
            return redirect()->back()->with('error', 'Invalid amount');
        }

        $apiKey1 = env('TAP_SECRET_KEY');
        // 1. بيانات الطلب
        $response = Http::withHeaders([
            'Authorization' => "Bearer $apiKey1",
            'Content-Type' => 'application/json',
        ])->post('https://api.tap.company/v2/charges', [
            "amount" => $amount, // المبلغ   changed
            "currency" => "SAR",
            "threeDSecure" => true,
            "save_card" => false,
            "description" => "طلب دفع",
            "statement_descriptor" => "Jospa Store",
            "customer" => [
                "first_name" => "ammar",
                "email" => "email@a.com",
            ],
            "source" => [
                "id" => "src_all"
            ],
            "redirect" => [
                "url" => url('/payment-success') // لينك الرجوع بعد الدفع
            ]
        ]);

        // 2. استقبل بيانات العملية
        $data = $response->json();

        // 3. لو فيه لينك للبوابة
        if (isset($data['transaction']['url'])) {
            return redirect()->to($data['transaction']['url']);
        }

        // 4. في حالة فشل
        return view('components.frontend.status.ERPAY');
    }


    public function handlePaymentResult(Request $request)
{
    $tapId = $request->get('tap_id');

    if (!$tapId) { 
        return view('components.frontend.status.ERPAY')->with('error', 'No tap_id provided.');
    }

    $response = Http::withHeaders([
        'Authorization' => 'Bearer ' . env('TAP_SECRET_KEY'),
    ])->get("https://api.tap.company/v2/charges/{$tapId}");

    $charge = $response->json();

    if (isset($charge['status']) && $charge['status'] === 'CAPTURED') {
        //  الدفع تم بنجاح، سجل البيانات في قاعدة البيانات أو فعل الاشتراك
        return view('components.frontend.status.CAPTURED');
    } else {
        //  الدفع فشل أو تم رفضه
        return view('components.frontend.status.FAILED');
    }
}




    //  SMS Method

    public function send(Request $request)
    {
        // التحقق من صحة البيانات
        $request->validate([
            'recipients' => 'required|array',  // mobile number array
            'body' => 'required|string', // content
        ]);

        // جلب الـ API Key من env
        $apiKey = env('TAQNYAT_API_KEY');

        // تنفيذ طلب الإرسال
        $response = Http::withHeaders([
            'Authorization' => "Bearer $apiKey",
            'Accept' => 'application/json',
        ])->post('https://api.taqnyat.sa/v1/messages', [
            'recipients' => $request->recipients,
            'body'      => $request->body,
            'sender'    => $request->sender,
        ]);

        // فحص النتيجة
        if ($response->successful()) {
            return response()->json([
                'status' => 'success',
                'data'   => $response->json()
            ]);
        } else {
            return response()->json([
                'status'  => 'error',
                'message' => $response->body()
            ], $response->status());
        }
    }
}
