<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Service\Models\Service;

class GiftCard extends Model
{
    protected $fillable = [
        'delivery_method',
        'sender_name',
        'recipient_name',
        'sender_phone',
        'recipient_phone',
        'requested_services',
        'options_amount',
        'subtotal',
    ];

    protected $casts = [
        'requested_services' => 'array',
    ];

public function getServicesListAttribute()
{
    return Service::whereIn('id', $this->requested_services ?? [])->get();
}
}