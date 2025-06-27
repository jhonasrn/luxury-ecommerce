<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShippingAddress extends Model
{
    protected $fillable = [
        'order_id',
        'full_name',
        'phone',
        'address_line',
        'city',
        'state',
        'zip_code',
    ];
}
