<?php

namespace App\Http\Controllers;
use App\Models\BookingCart;
use Illuminate\Http\Request;

class BookingCartController extends Controller
{

public function store(Request $request)
{
    $cart = BookingCart::create([
        'n_name'     => $request->n_name,
        'customer_id'     => 1, // change this
        'mobile_no'         => $request->mobile_no,
        'neighborhood'      => $request->neighborhood,
        'branch'            => $request->branch,//
        'gender'            => $request->gender,
        'service_group_id'  => $request->service_group_id,
        'service_id'        => $request->service_id,
        'date'              => $request->date,
        'time'              => $request->time,
        'staff_id'          => $request->staff_id,
        'status'          => $request->status,
        'agreed'          => $request->agreed,
        'auto_change_staff'          => $request->auto_change_staff,
    ]);
    return redirect()->route('cart.page')->with('success', 'تم إضافة الحجز إلى السلة بنجاح.');
}


public function destroy($id)
{
    // حذف العنصر من السلة مثلاً
    BookingCart::destroy($id); 
    return redirect()->back()->with('success', 'تم حذف العنصر من السلة');
}
}

