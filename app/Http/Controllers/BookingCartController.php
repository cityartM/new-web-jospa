<?php

namespace App\Http\Controllers;
use App\Models\BookingCart;
use App\Models\LoyaltyPoint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Modules\Booking\Models\Booking;
use Modules\Booking\Models\BookingService;

class BookingCartController extends Controller
{


    public function index(Request $request)
    {

        $cartItems = Booking::with('service.service', 'service.employee') // نحمل كل العلاقات الضرورية
        ->where('created_by', auth()->user()->id)
            ->get();
        //return $cartItems;
        $totalPrice = $cartItems->sum(function ($item) {
            return $item->services->sum(function ($s) {
                return $s->service_price ?? 0;
            });
        });

        return view('components.frontend.cart', compact('cartItems' , 'totalPrice'));
    }




    public function store(Request $request)
    {
        try {
            Log::info('Booking data before validated', $request->all());

            $data = $request->validate([
                'n_name'            => 'required|string|max:255',
                'customer_id'       => 'nullable|integer',
                'mobile_no'         => 'required|string|max:20',
                'neighborhood'      => 'required|string|max:255',
                'gender'            => 'required|in:men,women',
                'service_group_id'  => 'required',
                'service_id'        => 'required',
                'date'              => 'required|date',
                'time'              => 'required|string',
                'branch'            => 'nullable',
                'staff_id'          => 'required',
                'status'            => 'nullable|string',
                'agreed'            => 'nullable|boolean',
                'auto_change_staff' => 'nullable|boolean',
            ]);

            // 🟢 احسب التاريخ والوقت للحجز
            $startDateTime = \Carbon\Carbon::createFromFormat('Y-m-d h:i A', $data['date'] . ' ' . $data['time'])->format('Y-m-d H:i:s');

            // 🟢 إنشاء الحجز
            $booking = new Booking();
            $booking->note = 'العميل: ' . $data['n_name'] .
                '، الجوال: ' . $data['mobile_no'] .
                '، الحي: ' . $data['neighborhood'] .
                '، الجنس: ' . $data['gender'] .
                '، مجموعة الخدمة: ' . $data['service_group_id'] .
                '، الخدمة: ' . $data['service_id'];
            $booking->start_date_time = $startDateTime;
            $booking->user_id         = $data['staff_id'];
            $booking->branch_id       = 1;
            $booking->created_by      = auth()->id(); // أو 1 كما في الأصل
            $booking->status          = 'pending';
            $booking->save();

            // 🟢 إنشاء السطر المرتبط في جدول booking_services
            $bookingService = new BookingService();
            $bookingService->booking_id       = $booking->id;
            $bookingService->service_id       = $data['service_id'];
            $bookingService->employee_id      = $data['staff_id'];
            $bookingService->start_date_time  = $startDateTime;
            $bookingService->service_price    = \Modules\Service\Models\Service::find($data['service_id'])->default_price ?? 0;
            $bookingService->duration_min     = 30; // لو عندك قيمة ثابتة أو تحسبها حسب نوع الخدمة
            $bookingService->sequance         = 1; // أو عدّدهم لو عندك أكثر من خدمة
            $bookingService->created_by       = auth()->id(); // أو 1
            $bookingService->save();
            $pointsToAdd = 10;

            LoyaltyPoint::updateOrCreate(
                ['user_id' => $data['staff_id']],
                ['points' => DB::raw('points + ' . $pointsToAdd)]
            );
            return redirect()->route('cart.page')->with('success', 'تم إضافة الحجز إلى السلة بنجاح.');
        } catch (\Exception $e) {
            Log::error('Booking Store Error: ' . $e->getMessage(), [
                'stack' => $e->getTraceAsString(),
                'request_data' => $request->all(),
            ]);

            return response()->json([
                'message' => 'حدث خطأ أثناء حفظ الحجز',
                'error' => $e->getMessage(),
            ], 500);
        }
    }



    public function destroy($id)
    {
        // حذف العنصر من السلة مثلاً
        BookingCart::destroy($id);
        return redirect()->back()->with('success', 'تم حذف العنصر من السلة');
    }
}

