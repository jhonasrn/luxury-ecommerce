<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderItem;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    /**
     * Display the user dashboard with recent orders and suggested products.
     */
    public function dashboard()
    {
        // Buscar pedidos do usuário com produtos e imagens
        $orders = Order::with('items.product.primaryImage')
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        // Verificar a última compra
        $lastOrder = $orders->first();
        $lastProducts = $lastOrder?->items->pluck('product_id')->toArray() ?? [];

        // Sugerir produtos diferentes da última compra
        $suggestedProducts = Product::whereNotIn('id', $lastProducts)
            ->inRandomOrder()
            ->with('primaryImage')
            ->take(3)
            ->get();

        return view('client.dashboard', compact('orders', 'suggestedProducts'));
    }
}
