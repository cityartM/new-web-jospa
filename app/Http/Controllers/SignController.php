<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;
use Modules\Wallet\Models\Wallet;

class SignController extends Controller
{
    public function index()
    {
       
        return view("components.frontend.auth.signup" , compact('balance'));
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
        $wallet = Wallet::where('user_id', auth()->id())->first();
        $balance = $wallet ? $wallet->amount : 0.00;
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
    
    public function myBookings()
    {
        $user = auth()->user();
        $bookings = \App\Models\BookingCart::where('customer_id', $user->id)->get();
        return view('components.frontend.auth.my-bookings', compact('bookings'));
    }







    // payment-balance

    public function createPayment(Request $request)
    {
        
        $amount = $request->amount;
    
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
                "url" => url("/success-py?am=$amount") 
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

                $amount = floatval($request->query('am'));
                $wallet = Wallet::firstOrCreate(
                    ['user_id' => auth()->id()],
                    [
                        'amount' => 0,
                        'title' => auth()->user()->first_name . " " . auth()->user()->second_name,
                    ]                
                );
            
                $wallet->increment('amount', $amount);
            
            return view('components.frontend.status.CAPTURED');
        } else {

            return view('components.frontend.status.FAILED');
        }
    }
}


