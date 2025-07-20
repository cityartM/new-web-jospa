<?php

namespace App\Http\Controllers;

use App\Models\HomeBookService;
use App\Models\ServiceHome;
use App\Models\StaffHome;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\ServiceGroupHome;
use Carbon\Carbon;
use App\Models\StaffWorkingHour;
use Illuminate\Support\Facades\Auth;



// To Payment & SMS
use Illuminate\Support\Facades\Http;
use Modules\Booking\Models\Booking;
use Modules\Category\Models\Category;
use Modules\Service\Models\Service;
use Illuminate\Support\Facades\Log;


class HomeBookingController extends Controller
{

    public function getAvailableTimes($date, $staffId)
    {
        $workingHours = StaffWorkingHour::where('staff_id', $staffId)->first();

        if (!$workingHours) {
            return response()->json([]);
        }

        $start = Carbon::createFromFormat('H:i:s', $workingHours->start_time);
        $end = Carbon::createFromFormat('H:i:s', $workingHours->end_time);

        // 2. جلب أوقات الحجز الموجودة لذلك الموظف والتاريخ
        $bookedTimes = Booking::where('staff_id', $staffId)
            ->where('date', $date)
            ->pluck('start_date_time')
            ->map(function ($time) use ($date) {
                return $date . ' ' . $time . ':00'; // إذا time مثل '10:00'
            })
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

        $employees = User::role('employee')->get(); // هذا ميثود من spatie مباشرة
        return response()->json($employees);
    }

    public function getServiceGroups($gender)
    {
        $groups = Category::all();

        return response()->json($groups);
    }

    public function getServicesByGroup($serviceGroupId)
    {
        $services = Service::where('category_id', $serviceGroupId)->get();

        return response()->json($services);
    }

    public function store(Request $request)
    {
        try {
            Log::info('Booking data berfo validated successfully', $request);

            $data = $request->validate([
                'customer_name'     => 'required|string|max:255',
                'mobile_no'         => 'required|string|max:20',
                'neighborhood'      => 'required|string|max:255',
                'gender'            => 'required|in:men,women',
                'service_group_id'  => 'required|exists:service_group_homes,id',
                'service_id'        => 'required|exists:service_homes,id',
                'date'              => 'required|date',
                'time'              => 'required|string',
                'branch'            => 'required|exists:branches,id',
                'staff_id'          => 'required|exists:staff_homes,id',
            ]);
            Log::info('Booking data validated successfully', $data);

            $booking = new Booking();
            $booking->note = 'Customer: ' . $data['customer_name'] . ', Mobile: ' . $data['mobile_no'] .
                ', Neighborhood: ' . $data['neighborhood'] . ', Gender: ' . $data['gender'];
            $booking->status = 'pending';
            $booking->start_date_time = $data['date'] . ' ' . $data['time'];
            $booking->user_id = $data['staff_id'];
            $booking->branch_id = $data['branch'];
            $booking->created_by = 1;

            $booking->save();

            return response()->json(['message' => 'Booking saved successfully']);
        } catch (\Exception $e) {
            // 🧾 سجل الخطأ في ملف laravel.log
            Log::error('Booking Store Error: ' . $e->getMessage(), [
                'stack' => $e->getTraceAsString(),
                'request_data' => $request->all(),
            ]);

            return response()->json([
                'message' => 'حدث خطأ أثناء حفظ الحجز',
                'error' => $e->getMessage(), // اختياري للـ debug فقط، احذف في الإنتاج
            ], 500);
        }
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
                "first_name" => auth()->user()->first_name,
                "email" => auth()->user()->email ,
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
