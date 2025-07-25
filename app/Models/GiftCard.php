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
    $serviceIds = json_decode($this->requested_services ?? '[]', true);

    if (!is_array($serviceIds)) {
        return collect();
    }

    return Service::whereIn('id', $serviceIds)->get();
}
}