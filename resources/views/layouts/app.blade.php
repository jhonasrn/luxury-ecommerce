<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>@yield('title', 'Luxury Ecommerce')</title>

    <!-- Fonte elegante -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    <!-- Font Awesome para ícones -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <!-- Tailwind + Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 text-gray-900 antialiased">

{{-- Top bar com espaçamento entre os links --}}
<div class="bg-gray-100 text-gray-700 text-sm">
    <div class="max-w-7xl mx-auto px-4 py-2 flex justify-between items-center">
        <div>
            Free shipping on orders over $199 · 10% OFF your first purchase ✨
        </div>
        <div class="flex gap-6">
            <a href="#" class="hover:underline">Sign In</a>
            <a href="#" class="hover:underline">Sign Up</a>
            <a href="#" class="hover:underline flex items-center gap-2">
                <i class="fa-solid fa-bag-shopping text-gray-600"></i>
                Bag
            </a>
        </div>
    </div>
</div>


{{-- Navigation --}}
<nav class="bg-white shadow text-sm">
    <div class="max-w-7xl mx-auto px-4 py-3 flex items-center justify-between">
        
        {{-- Logo --}}
        <a href="/" class="text-xl font-semibold text-gray-800">Luxury</a>

        {{-- Menu + Busca --}}
        <div class="flex items-center space-x-6 text-gray-600">
            <a href="#" class="hover:text-black">Collection</a>
            <a href="#" class="hover:text-black">About</a>
            <a href="#" class="hover:text-black">Contact</a>

            {{-- Campo de busca como item de menu --}}
            <form action="#" method="GET">
                <input 
                    type="text" 
                    name="search" 
                    placeholder="Search..." 
                    class="px-3 py-1.5 border border-gray-300 rounded-md text-sm w-48 focus:outline-none focus:ring-1 focus:ring-rose-400"
                >
            </form>
        </div>
    </div>
</nav>

{{-- Conteúdo principal --}}
    <main>
        @yield('content')
    </main>

</body>
</html>
