<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Http\Controllers\{
    Auth\RegisteredUserController,
    Auth\AuthenticatedSessionController,
    Auth\PasswordResetLinkController,
    Auth\NewPasswordController,
    Auth\EmailVerificationPromptController,
    Auth\VerifyEmailController,
    Auth\EmailVerificationNotificationController,
    Auth\ConfirmablePasswordController,
    Auth\PasswordController,
    ProfileController,
    ProductController,
    BagController,
    CheckoutController,
    OrderController,
    CollectionController
};

//
// Public homepage
//
Route::get('/', function () {
    return view('home', [
        'sunglasses' => Product::where('category', 'Sunglasses')->take(3)->get(),
        'watches' => Product::where('category', 'Watches')->take(3)->get(),
        'bags' => Product::where('category', 'Bags')->take(3)->get(),
        'fragrances' => Product::where('category', 'Fragrances')->take(3)->get(),
    ]);
})->name('home');

//
// Authentication (register, login, logout)
//
Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store']);
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store']);
});

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

//
// Collection overview + categories
//
Route::get('/collection', function () {
    $categories = [
        'sunglasses' => 'Sunglasses',
        'watches' => 'Watches',
        'bags' => 'Bags',
        'perfumes' => 'Fragrances',
    ];

    $images = [];

    foreach ($categories as $slug => $label) {
        $image = DB::table('product_images')
            ->join('products', 'product_images.product_id', '=', 'products.id')
            ->where('products.category', $label)
            ->where('product_images.is_primary', true)
            ->value('product_images.url');

        $images[$slug] = [
            'label' => $label,
            'image' => $image,
        ];
    }

    return view('collection', ['images' => $images]);
})->name('collection');

Route::get('/collection/{category}', function ($category) {
    $categories = [
        'sunglasses' => 'Sunglasses',
        'watches' => 'Watches',
        'bags' => 'Bags',
        'perfumes' => 'Fragrances',
    ];

    if (!array_key_exists($category, $categories)) {
        abort(404);
    }

    $label = $categories[$category];
    $products = Product::where('category', $label)->paginate(6);

    return view('collection-category', [
        'products' => $products,
        'category' => $category,
        'label' => $label,
    ]);
})->name('collection.category');

//
// Product + Bag
//
Route::get('/product/{slug}', [ProductController::class, 'show'])->name('product.show');
Route::get('/bag', [BagController::class, 'index'])->name('bag.index');
Route::post('/bag/add', [BagController::class, 'add'])->name('bag.add');
Route::post('/bag/remove', [BagController::class, 'remove'])->name('bag.remove');

//
// Checkout
//
Route::middleware(['auth'])->group(function () {
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
});

Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
Route::get('/checkout/success', fn() => view('checkout.success'))->name('checkout.success');

//
// User dashboard/profile
//
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', fn() => view('dashboard'))->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
