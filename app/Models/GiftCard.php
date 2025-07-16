<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GiftCard extends Model
{
    protected $fillable = [
        'delivery_method',
        'sender_name',
        'recipient_name',
        'sender_phone',
        'recipient_phone',
        'requested_services',
        'selected_services',
        'options_amount',
        'subtotal',
    ];

    protected $casts = [
        'selected_services' => 'array',
    ];
}
