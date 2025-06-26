<!-- Top Bar: Login / Sign Up / Bag -->
<div class="bg-gray-100 text-gray-600 text-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-2 flex justify-between items-center">
        <div></div>
        <div class="flex items-center space-x-10">
            @auth
                <span>Olá, {{ Auth::user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="hover:underline text-rose-600">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="hover:underline">Sign In |</a>
                <a href="{{ route('register') }}" class="hover:underline">Sign Up</a>
            @endauth

            <a href="#" class="flex items-center text-gray-600 hover:text-gray-800">
                <svg class="h-5 w-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13l-1.6 8m14.6-8L17 21H7" />
                </svg>
                <span class="text-sm">Bag</span>
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
                <a href="{{ route('home') }}" class="text-sm text-gray-700 hover:text-black mx-[32px]" style="margin-right: 32px;">Home</a>
                <a href="#" class="text-sm text-gray-700 hover:text-black mx-[32px]" style="margin-right: 32px;">Collection</a>
                <a href="#" class="text-sm text-gray-700 hover:text-black mx-[32px]" style="margin-right: 32px;">About</a>
                <a href="#" class="text-sm text-gray-700 hover:text-black mx-[32px]">Contact</a>
            </div>
            <!-- Search -->
            <div class="hidden md:block">
                <input type="text" placeholder="Search products..." class="border rounded-md px-3 py-1 text-sm text-gray-700 focus:outline-none focus:ring-1 focus:ring-gray-400" />
            </div>
        </div>
    </div>
</nav>
