<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'user_id',
        'card_name',
        'card_number',
        'expiration_date',
        'cvv',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
// This model represents a payment method associated with a user.