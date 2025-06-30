@php
    use App\Models\ShoppingBag;

    $bagCount = auth()->check()
        ? ShoppingBag::where('user_id', auth()->id())->sum('quantity')
        : collect(session('bag'))->sum();
@endphp

<!-- Top Bar: Login / Sign Up / Bag -->
<div class="bg-gray-100 text-gray-600 text-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-2 flex justify-between items-center">
        <div></div>

        <div class="flex items-center space-x-10">
            @auth
                <!-- Dropdown do usuário -->
                <div class="relative group inline-block text-left">
                    <button class="inline-flex items-center text-sm text-gray-700 hover:text-black focus:outline-none">
                        <svg class="w-5 h-5 mr-1 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M15.75 7.5a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.5 20.25a8.25 8.25 0 1115 0" />
                        </svg>
                        <span>{{ Auth::user()->name }}</span>
                        <svg class="ml-1 w-4 h-4 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.5 7l4.5 4 4.5-4" clip-rule="evenodd" />
                        </svg>
                    </button>

                    <div class="absolute right-0 z-50 mt-0 w-44 bg-white border border-gray-200 rounded shadow-md opacity-0 group-hover:opacity-100 invisible group-hover:visible transition duration-200">
                        <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            Perfil
                        </a>
                        <a href="{{ route('orders.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            My Orders
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full text-left block px-4 py-2 text-sm text-rose-600 hover:bg-gray-100">
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            @else
                <!-- Acesso para visitantes -->
                <span class="text-sm text-gray-600">
                    <a href="{{ route('login') }}" class="hover:underline">Sign In</a>
                    <span class="mx-1">|</span>
                    <a href="{{ route('register') }}" class="hover:underline">Sign Up</a>
                </span>
            @endauth

            <!-- Bag -->
            <a href="{{ route('bag.index') }}" class="flex items-center text-gray-600 hover:text-gray-800 relative">
                <svg class="h-5 w-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                          d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13l-1.6 8m14.6-8L17 21H7" />
                </svg>
                <span class="text-sm">Bag</span>
                @if ($bagCount > 0)
                    <span class="ml-1 text-xs text-indigo-600 font-semibold">({{ $bagCount }})</span>
                @endif
            </a>
        </div>
    </div>
</div>

<!-- Main Navigation -->
<nav class="bg-white border-b border-gray-200 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Logo -->
            <a href="{{ route('home') }}" class="text-xl font-bold text-gray-900">Luxury</a>

            <!-- Navigation Links -->
            <div class="hidden md:flex items-center">
                <a href="{{ route('home') }}" class="text-sm text-gray-700 hover:text-black mx-8">Home</a>

                <!-- Collection Dropdown -->
                <div class="relative group mx-8">
                    <a href="{{ route('collection') }}" class="text-sm text-gray-700 hover:text-black inline-flex items-center">
                        Collection
                        <svg class="ml-1 h-4 w-4" fill="none" viewBox="0 0 20 20">
                            <path d="M5.5 7l4.5 4 4.5-4" stroke="currentColor" stroke-width="1.5" fill="none" />
                        </svg>
                    </a>
                    <div class="absolute left-0 top-full bg-white shadow-md rounded-md opacity-0 group-hover:opacity-100 invisible group-hover:visible transition duration-200 ease-in-out w-48 z-50">
                        <a href="{{ route('collection.category', 'sunglasses') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Sunglasses</a>
                        <a href="{{ route('collection.category', 'watches') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Watches</a>
                        <a href="{{ route('collection.category', 'bags') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Bags</a>
                        <a href="{{ route('collection.category', 'perfumes') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Perfumes</a>
                    </div>
                </div>

                <a href="{{ url('/about') }}" class="text-sm font-medium text-gray-600 hover:text-gray-900">
                    About
                </a>
                <a href="{{ route('help') }}" class="text-sm text-gray-700 hover:text-black mx-8">Contact</a>

            </div>

            <!-- Search -->
            <div class="hidden md:block">
                <input type="text" placeholder="Search products..." class="border rounded-md px-3 py-1 text-sm text-gray-700 focus:outline-none focus:ring-1 focus:ring-gray-400" />
            </div>
        </div>
    </div>
</nav>
