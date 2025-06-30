<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\{
    Auth\RegisteredUserController,
    Auth\AuthenticatedSessionController,
    Auth\PasswordController,
    ProfileController,
    ProductController,
    BagController,
    CheckoutController,
    OrderController,
    AdminAuthController
};
use App\Models\Product;

// ==== ADMIN AREA ====

// Admin login routes (públicas para visitantes)
Route::middleware('guest')->prefix('admin')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');
});

// Admin dashboard e recursos (protegido por autenticação e verificação de admin)
Route::middleware(['admin.auth', \App\Http\Middleware\IsAdmin::class])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::view('/', 'admin.dashboard')->name('dashboard');

        // Products
        Route::resource('products', \App\Http\Controllers\Admin\ProductController::class);

        // Orders
        Route::resource('orders', \App\Http\Controllers\Admin\OrderController::class);

        // Users
        Route::resource('users', \App\Http\Controllers\Admin\UserController::class);

        // Reports
        Route::get('reports', [\App\Http\Controllers\Admin\ReportController::class, 'index'])->name('reports.index');
    });

// ==== USER AUTHENTICATION ====

Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store']);
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store']);
});

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

// ==== HOMEPAGE ====

Route::get('/', function () {
    return view('home', [
        'sunglasses' => Product::where('category', 'Sunglasses')->take(3)->get(),
        'watches' => Product::where('category', 'Watches')->take(3)->get(),
        'bags' => Product::where('category', 'Bags')->take(3)->get(),
        'fragrances' => Product::where('category', 'Fragrances')->take(3)->get(),
    ]);
})->name('home');

// ==== COLLECTIONS ====

Route::get('/collection', fn () => view('collection', [
    'images' => collect([
        'sunglasses' => 'Sunglasses',
        'watches' => 'Watches',
        'bags' => 'Bags',
        'perfumes' => 'Fragrances',
    ])->mapWithKeys(fn ($label, $slug) => [
        $slug => [
            'label' => $label,
            'image' => DB::table('product_images')
                ->join('products', 'product_images.product_id', '=', 'products.id')
                ->where('products.category', $label)
                ->where('product_images.is_primary', true)
                ->value('product_images.url'),
        ],
    ]),
]))->name('collection');

Route::get('/collection/{category}', function ($category) {
    $map = [
        'sunglasses' => 'Sunglasses',
        'watches' => 'Watches',
        'bags' => 'Bags',
        'perfumes' => 'Fragrances',
    ];

    abort_if(!array_key_exists($category, $map), 404);

    return view('collection-category', [
        'products' => Product::where('category', $map[$category])->paginate(6),
        'category' => $category,
        'label' => $map[$category],
    ]);
})->name('collection.category');

// ==== PRODUCT & SHOPPING BAG ====

Route::get('/product/{slug}', [ProductController::class, 'show'])->name('product.show');
Route::get('/bag', [BagController::class, 'index'])->name('bag.index');
Route::post('/bag/add', [BagController::class, 'add'])->name('bag.add');
Route::post('/bag/remove', [BagController::class, 'remove'])->name('bag.remove');

// ==== CHECKOUT ====

Route::middleware('auth')->group(function () {
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::put('/profile/password', [PasswordController::class, 'update'])->name('password.update');
});

Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
Route::get('/checkout/success', fn () => view('checkout.success'))->name('checkout.success');
Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');

// ==== USER PROFILE ====
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/client/dashboard', [ProfileController::class, 'dashboard'])->name('client.dashboard');

    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/profile', fn () => view('profile', ['user' => auth()->user()]))->name('profile.edit');
});

// ==== STATIC PAGES ====

Route::view('/about', 'about')->name('about');
Route::view('/policies/shipping-returns', 'policies.shipping-returns')->name('policies.shipping');
Route::view('/policies/privacy', 'policies.privacy')->name('policies.privacy');
Route::view('/policies/terms', 'policies.terms')->name('policies.terms');
Route::view('/help', 'help.index')->name('help');

