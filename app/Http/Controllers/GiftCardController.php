<?php

namespace App\Http\Controllers;

use App\Models\GiftCard;
use App\Models\Service;
use Illuminate\Http\Request;

class GiftCardController extends Controller
{

  public function store(Request $request)
    {
        $data = $request->validate([
            'delivery_method'     => 'required|string',
            'sender_name'         => 'required|string',
            'recipient_name'      => 'required|string',
            'sender_phone'        => 'nullable|string',
            'recipient_phone'     => 'nullable|string',
            'requested_services'  => 'nullable|string|max:100',
            'selected_services'   => 'nullable|array',
            'options_amount'      => 'nullable|numeric',
            'subtotal'            => 'nullable|numeric',
        ]);

        $giftCard = GiftCard::create($data);

            return redirect()->back()->with('success', 'تم إنشاء البطاقة بنجاح');

    }
}
