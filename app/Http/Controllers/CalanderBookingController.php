<?php

namespace App\Http\Controllers;

use App\Models\BookingCart;
use App\Models\User;
use Illuminate\Http\Request;
use Modules\Service\Models\Service;

class CalanderBookingController extends Controller
{
    public function getservices(){
        $services = Service::all();
        return $services;
    }
    public function emplouee(){
        $employees = User::role('employee')->get(); // من Spatie

        return response()->json([
            'employees' => $employees
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validated();

        $booking = BookingCart::create([
            'n_name'              => $data['clientName'], // ← الاسم
            'mobile_no'           => $data['clientPhone'], // ← رقم الهاتف
            'customer_id'         => auth()->id() ?? null, // ← إن كان المستخدم مسجلاً
            'neighborhood'        => $data['location'], // ← الموقع
            'branch'              => $data['branch'] ?? null, // ← فرع إذا موجود
            'gender'              => $data['gender'] ?? null, // ← اختيارية
            'service_group_id'    => $data['service_group_id'] ?? null, // ← إذا كانت موجودة
            'service_id'          => $data['service'], // ← ID الخدمة
            'date'                => $data['bookingDate'], // ← تاريخ الحجز
            'time'                => $data['bookingTime'], // ← وقت الحجز
            'staff_id'            => $data['staff_id'], // ← الموظف
            'status'              => 'pending', // ← الحالة الابتدائية
            'agreed'              => $data['agreed'] ?? false, // ← إذا وافق على الشروط مثلاً
            'auto_change_staff'   => $data['auto_change_staff'] ?? false, // ← إذا سمح بتبديل الموظف تلقائياً
        ]);

        return response()->json([
            'message' => 'Booking created successfully',
            'booking' => $booking
        ], 201);
    }
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'clientName' => ['required', 'string'],
            'clientPhone' => ['required', 'string'],
            'location' => ['required', 'string'],
            'bookingDate' => ['required', 'date'],
            'bookingTime' => ['required', 'string'],
            'service' => ['required', 'exists:services,id'],
            'staff_id' => ['required', 'exists:staff_homes,id'],
            'branch' => ['nullable', 'string'],
            'gender' => ['nullable', 'in:male,female'],
            'service_group_id' => ['nullable', 'exists:service_group_homes,id'],
            'agreed' => ['nullable', 'boolean'],
            'auto_change_staff' => ['nullable', 'boolean'],
        ]);

        $booking = BookingCart::findOrFail($id);

        $booking->update([
            'n_name'              => $data['clientName'],
            'mobile_no'           => $data['clientPhone'],
            'neighborhood'        => $data['location'],
            'branch'              => $data['branch'] ?? null,
            'gender'              => $data['gender'] ?? null,
            'service_group_id'    => $data['service_group_id'] ?? null,
            'service_id'          => $data['service'],
            'date'                => $data['bookingDate'],
            'time'                => $data['bookingTime'],
            'staff_id'            => $data['staff_id'],
            'agreed'              => $data['agreed'] ?? false,
            'auto_change_staff'   => $data['auto_change_staff'] ?? false,
        ]);

        return response()->json([
            'message' => 'Booking updated successfully',
            'booking' => $booking
        ]);
    }
    public function destroy($id)
    {
        $booking = BookingCart::findOrFail($id);

        $booking->delete();

        return response()->json([
            'message' => 'Booking deleted successfully.'
        ]);
    }
    public function getAllByTime(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'time' => 'required|string', // e.g., "14:00"
        ]);

        $bookings = BookingCart::where('date', $request->date)
            ->where('time', $request->time)
            ->get();

        return response()->json([
            'bookings' => $bookings
        ]);
    }

    public function getAllByDay(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
        ]);

        $bookings = BookingCart::where('date', $request->date)->get();

        return response()->json([
            'bookings' => $bookings
        ]);
    }

}
