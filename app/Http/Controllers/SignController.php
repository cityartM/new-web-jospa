<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class SignController extends Controller
{
    public function index()
    {
        return view("components.frontend.auth.signup");
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name'            => 'required|string|max:255',
            'last_name'             => 'required|string|max:255',
            'mobile'                => 'required|string|unique:users,mobile',
            'email'                 => 'required|email|unique:users,email',
            'password'              => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'first_name' => $validated['first_name'],
            'last_name'  => $validated['last_name'],
            'mobile'     => $validated['mobile'],
            'email'      => $validated['email'],
            'password'   => Hash::make($validated['password']),
            'gender'   => "female",
            'status'   => 1,
        ]);

        auth()->login($user, true);

            return redirect()->to('/')->with('success', 'تم انشاء حساب بنجاح');
            }
            public function login()
            {
                return view("components.frontend.auth.signin");
            }

            public function verify(Request $request)
            {
            $credentials = $request->validate([
                'email'    => 'required|email',
                'password' => 'required|string|min:6',
            ]);

            if (auth()->attempt($credentials, $request->filled('remember'))) {
                $request->session()->regenerate(); 

                return redirect()->to('/')->with('success', 'تم تسجيل الدخول بنجاح');
            }

            return back()->withErrors([
                'email' => 'بيانات تسجيل الدخول غير صحيحة',
            ])->withInput();
    }

    public function profile()
    {
        $user = auth()->user();
        $balance = $user->wallet->balance ?? 0;
        return view('components.frontend.auth.profile', compact('user', 'balance'));
    }
}
