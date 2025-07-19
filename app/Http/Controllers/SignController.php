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



    public function update(Request $request, $id)
    {
        $request->validate([
            'first_name'     => 'required|string|max:255',
            'last_name'      => 'required|string|max:255',
            'mobile'         => 'required|string|max:20',
            'email'          => 'required|email|max:255|unique:users,email,' . $id,
            'address'        => 'nullable|string|max:255',
            'city'           => 'nullable|string|max:255',
            'country'        => 'nullable|string|max:255',
            'date_of_birth'  => 'nullable|date|before:today',
            'profile_image'  => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);
    
        $data = [];
    
        if ($request->hasFile('profile_image')) {
            $image = $request->file('profile_image');
            $imageName = 'user_' . $id . '_' . time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('profile_images'), $imageName);
            $data['avatar'] = 'profile_images/' . $imageName;
        } else {
            $data['avatar'] = auth()->user()->avatar;
        }
    
        $data['first_name']    = $request->first_name;
        $data['last_name']     = $request->last_name;
        $data['email']         = $request->email;
        $data['mobile']        = $request->mobile;
        $data['date_of_birth'] = $request->date_of_birth;
        $data['address']       = $request->address;
        $data['city']          = $request->city;
        $data['country']       = $request->country;
    
        User::where('id', $id)->update($data);
    
        return redirect()->back()->with('success', __('messages.profile_updated'));
    }
    
    
}


