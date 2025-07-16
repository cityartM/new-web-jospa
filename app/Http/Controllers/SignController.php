<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SignController extends Controller
{
    public function store(Request $request)
{
    try {
        $user = $this->registerTrait($request);
        Auth::login($user);

        // إعادة التوجيه مع رسالة نجاح
        return redirect()->route('frontend.register')->with('success', 'تم إنشاء الحساب بنجاح!');
    } catch (\Exception $e) {
        // إعادة التوجيه مع رسالة خطأ
        return redirect()->back()->withInput()->with('error', 'حدث خطأ أثناء التسجيل: ' . $e->getMessage());
    }
}
}
