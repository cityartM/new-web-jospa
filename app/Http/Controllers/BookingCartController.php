<?php

namespace App\Http\Controllers;
use App\Models\BookingCart;
use Illuminate\Http\Request;

class BookingCartController extends Controller
{

public function index(Request $request)
{

    $cartItems = BookingCart::where('customer_id', 1)->get();

    $totalPrice = $cartItems->sum(function ($item) {
        return $item->service->price ?? 0; // لو service مش موجود ترجع 0 بدل ما يعمل خطأ
    });

    return view('components.frontend.cart', compact('cartItems' , 'totalPrice')); 
}




public function store(Request $request)
{
    $cart = BookingCart::create([
        'n_name'     => $request->n_name,
        'customer_id'     => $request->customer_id,
        'mobile_no'         => $request->mobile_no,
        'neighborhood'      => $request->neighborhood,
        'branch'            => $request->branch,
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

