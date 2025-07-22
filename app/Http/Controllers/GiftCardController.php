<?php

namespace App\Http\Controllers;

use App\Models\GiftCard;
use Illuminate\Support\Facades\Http;
use App\Models\Service;
use Illuminate\Http\Request;
use Modules\Category\Models\Category;
use Modules\Service\Models\Service as ServiceModel;

class GiftCardController extends Controller
{

    public function index(){
        
    $subCategories = Category::with(['Services' => function ($q) {$q->select('id', 'name', 'default_price','category_id', 'sub_category_id')->where('status', 1);}])
    ->whereNull('parent_id')
    ->where('status', 1)
    ->get();

    return view('salon.gift' , compact('subCategories'));
    }


 public function store(Request $request)
{
    // 1. التحقق من صحة البيانات
    $data = $request->validate([
        'delivery_method'     => 'required|string',
        'sender_name'         => 'required|string',
        'recipient_name'      => 'required|string',
        'sender_phone'        => 'required',
        'recipient_phone'     => 'required',
        'requested_services'  => 'required|array|min:1',
    ], [
        'delivery_method.required'     => __('messages.gift_card_delivery_method_required'),
        'sender_name.required'         => __('messages.gift_card_sender_required'),
        'recipient_name.required'      => __('messages.gift_card_recipient_required'),
        'sender_phone.required'        => __('messages.gift_card_phone_required'),
        'recipient_phone.required'     => __('messages.gift_card_phone_required'),
        'requested_services.required'  => __('messages.gift_card_service_required'),
        'requested_services.min'       => __('messages.gift_card_service_required'),
    ]);

    try {
        // 2. التأكد من أن الخدمات مصفوفة صحيحة وتحويلها لأرقام
        $selectedServices = array_map('intval', $data['requested_services']);

        // 3. جلب الخدمات من قاعدة البيانات
        $services = \App\Models\Service::whereIn('id', $selectedServices)->get();

        // 4. حساب المجموع الإجمالي
        $total = $services->sum('default_price');

        // 5. تخزين البيانات في السيشن
        session([
            'gift_card_data' => array_merge($data, [
                'requested_services' => $selectedServices, // تأكد إنها array مش string
            ]),
            'gift_card_total' => $total,
        ]);

        // 6. إرسال طلب الدفع إلى TAP
        $apiKey = env('TAP_SECRET_KEY');
        $response = \Illuminate\Support\Facades\Http::withHeaders([
            'Authorization' => "Bearer $apiKey",
            'Content-Type'  => 'application/json',
        ])->post('https://api.tap.company/v2/charges', [
            "amount" => $total,
            "currency" => "SAR",
            "threeDSecure" => true,
            "save_card" => false,
            "description" => "طلب دفع",
            "statement_descriptor" => "Jospa Store",
            "customer" => [
                "first_name" => auth()->user()->first_name,
                "email" => auth()->user()->email,
            ],
            "source" => [
                "id" => "src_all"
            ],
            "redirect" => [
                "url" => url("/success-py-gift?am=$total")
            ]
        ]);

        $res = $response->json();

        // 7. التحقق من وجود رابط الدفع
        if (isset($res['transaction']['url'])) {
            return redirect()->to($res['transaction']['url']);
        }

        // 8. فشل إنشاء الدفع
        return view('components.frontend.status.ERPAY');

    } catch (\Exception $e) {
        return redirect()->back()->with('error', __('messages.payment_failed'))->withInput();
    }
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
            // استرجع البيانات من السيشن
            $data = session('gift_card_data');
            $total = session('gift_card_total');
    
            if (!$data || !$total) {
                return view('components.frontend.status.ERPAY')->with('error', 'Missing session data.');
            }
    
            // احفظ بيانات كرت الهدية
            $giftCard = GiftCard::create([
                'delivery_method'   => $data['delivery_method'],
                'sender_name'       => $data['sender_name'],
                'recipient_name'    => $data['recipient_name'],
                'sender_phone'      => $data['sender_phone'],
                'recipient_phone'   => $data['recipient_phone'],
                'requested_services' => json_encode($data['requested_services']),
                'subtotal'          => $total,
            ]);
    
            session()->forget(['gift_card_data', 'gift_card_total']);
    
            return view('components.frontend.status.CAPTURED');
        } else {
            return view('components.frontend.status.FAILED');
        }
    }
        
        
}