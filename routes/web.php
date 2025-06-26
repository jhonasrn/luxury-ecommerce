<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Str;
use App\Http\Controllers\Auth\{
    RegisteredUserController,
    AuthenticatedSessionController,
    PasswordResetLinkController,
    NewPasswordController,
    EmailVerificationPromptController,
    VerifyEmailController,
    EmailVerificationNotificationController,
    ConfirmablePasswordController,
    PasswordController
};

//
// 🌐 Public homepage
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
// 🔐 Authentication (register, login, logout)
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
// Collection overview page (boxes with images)
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

//
// Collection category pages (paginated by 6)
//
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

    $products = Product::where('category', $label)
        ->paginate(6);

    return view('collection-category', [
        'products' => $products,
        'category' => $category,
        'label' => $label,
    ]);
})->name('collection.category');

//
// Dashboard & user profile (authenticated only)
//
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//
// Product details (public)
//
use App\Http\Controllers\ProductController;

Route::get('/product/{slug}', [ProductController::class, 'show'])->name('product.show');

