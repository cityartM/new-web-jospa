<?php

namespace App\Http\Controllers;

use App\Models\GiftCard;
use App\Models\Service;
use Illuminate\Http\Request;
use Modules\Category\Models\Category;
use Modules\Service\Models\Service as ServiceModel;

class GiftCardController extends Controller
{

    public function index(){
        
        $subCategories = Category::with(['Services' => function ($q) {
            $q->select('id', 'name', 'default_price','category_id', 'sub_category_id')
                ->where('status', 1);
        }])
        ->whereNull('parent_id')
        ->where('status', 1)
        ->get();

        
        return view('salon.gift' , compact('subCategories'));

        }
        public function store(Request $request)
        {
            // التحقق من البيانات
            $data = $request->validate([
                'delivery_method'     => 'required|string',
                'sender_name'         => 'required|string',
                'recipient_name'      => 'required|string',
                'sender_phone'        => 'required',
                'recipient_phone'     => 'required',
                'selected_services'   => 'required|array|min:1',
            ], [
                'delivery_method.required'     => __('messages.gift_card_delivery_method_required'),
                'sender_name.required'         => __('messages.gift_card_sender_required'),
                'recipient_name.required'      => __('messages.gift_card_recipient_required'),
                'sender_phone.required'        => __('messages.gift_card_phone_required'),
                'recipient_phone.required'     => __('messages.gift_card_phone_required'),
                'selected_services.required'   => __('messages.gift_card_service_required'),
                'selected_services.min'        => __('messages.gift_card_service_required'),
            ]);
        
            try {
                // 1. هات الخدمات المختارة
                $selectedServices = $data['selected_services'];
                $services = ServiceModel::whereIn('id', $selectedServices)->get();
        
                // 2. احسب السعر الإجمالي
                $total = $services->sum('default_price');
        
                // 3. أنشئ بطاقة الهدية مع دمج التوتال
                $giftCard = GiftCard::create([
                    'delivery_method'   => $data['delivery_method'],
                    'sender_name'       => $data['sender_name'],
                    'recipient_name'    => $data['recipient_name'],
                    'sender_phone'      => $data['sender_phone'],
                    'recipient_phone'   => $data['recipient_phone'],
                    'subtotal'          => $total,
                ]);
        
                // 4. اربط الخدمات بالبطاقة (لو في علاقة many-to-many)
                $giftCard->services()->attach($selectedServices);
        
                return redirect()->back()->with('success', __('messages.gift_card_created'));
        
            } catch (\Exception $e) {
                return redirect()->back()
                    ->with('error', __('messages.gift_card_error'))
                    ->withInput();
            }
        }
        
}
