<?php

namespace App\Http\Controllers;

use App\Models\GiftCard;
use App\Models\Service;
use Illuminate\Http\Request;
use Modules\Category\Models\Category;

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
        $data = $request->validate([
            'delivery_method'     => 'required|string',
            'sender_name'         => 'required|string',
            'recipient_name'      => 'required|string',
            'sender_phone'        => 'required',
            'recipient_phone'     => 'required',
            'optional_services'      => 'nullable|numeric',
            'selected_services'   => 'nullable|array',
            'total'            => 'nullable|numeric',
        ]);

        $giftCard = GiftCard::create($data);

            return redirect()->back()->with('success', 'تم إنشاء البطاقة بنجاح');

    }
}
