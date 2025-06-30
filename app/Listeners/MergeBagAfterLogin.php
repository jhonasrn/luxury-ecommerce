<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use App\Models\ShoppingBag;

class MergeBagAfterLogin
{
    public function handle(Login $event)
    {
        $sessionBag = session()->get('bag', []);
        $user = $event->user;

        foreach ($sessionBag as $productId => $quantity) {
            $item = ShoppingBag::firstOrNew([
                'user_id' => $user->id,
                'product_id' => $productId,
            ]);
            $item->quantity += $quantity;
            $item->save();
        }

        session()->forget('bag'); // esvaziar session após merge
    }
}
