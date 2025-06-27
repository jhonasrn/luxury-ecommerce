<!-- Top Bar: Login / Sign Up / Bag -->
<div class="bg-gray-100 text-gray-600 text-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-2 flex justify-between items-center">
        <div></div>
        <div class="flex items-center space-x-10">
            @auth
                <span>Hello, {{ Auth::user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="hover:underline text-rose-600">Logout</button>
                </form>
            @else
                <span class="text-sm text-gray-600">
                    <a href="{{ route('login') }}" class="hover:underline">Sign In</a>
                    <span class="mx-1">|</span>
                    <a href="{{ route('register') }}" class="hover:underline">Sign Up</a>
                </span>
            @endauth
            @php
                $bagCount = collect(session('bag'))->sum();
            @endphp

            <a href="{{ route('bag.index') }}" class="flex items-center text-gray-600 hover:text-gray-800">
                <svg class="h-5 w-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13l-1.6 8m14.6-8L17 21H7" />
                </svg>
                <span class="text-sm">Bag</span>
                @if ($bagCount > 0)
                    <span class="ml-1 text-xs text-indigo-600 font-semibold">({{ $bagCount }})</span>
                @endif
            </a>
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
                <a href="{{ route('home') }}" class="text-sm text-gray-700 hover:text-black mx-[32px]">Home</a>

                <!-- Collection Dropdown -->
                <div class="relative group mx-[32px]">
                    <a href="{{ route('collection') }}" class="text-sm text-gray-700 hover:text-black inline-flex items-center">
                        Collection
                        <svg class="ml-1 h-4 w-4" fill="none" viewBox="0 0 20 20">
                            <path d="M5.5 7l4.5 4 4.5-4" stroke="currentColor" stroke-width="1.5" fill="none" />
                        </svg>
                    </a>

                    <!-- Submenu encostado -->
                    <div class="absolute left-0 top-full bg-white shadow-md rounded-md opacity-0 group-hover:opacity-100 invisible group-hover:visible transition duration-200 ease-in-out w-48 z-50">
                        <a href="{{ route('collection.category', 'sunglasses') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            Sunglasses
                        </a>
                        <a href="{{ route('collection.category', 'watches') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            Watches
                        </a>
                        <a href="{{ route('collection.category', 'bags') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            Bags
                        </a>
                        <a href="{{ route('collection.category', 'perfumes') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            Perfumes
                        </a>
                    </div>
                </div>

                <a href="#" class="text-sm text-gray-700 hover:text-black mx-[32px]">About</a>
                <a href="#" class="text-sm text-gray-700 hover:text-black mx-[32px]">Contact</a>
            </div>

            <!-- Search -->
            <div class="hidden md:block">
                <input type="text" placeholder="Search products..." class="border rounded-md px-3 py-1 text-sm text-gray-700 focus:outline-none focus:ring-1 focus:ring-gray-400" />
            </div>
        </div>
    </div>
</nav>
