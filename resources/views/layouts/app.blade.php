<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Luxury Ecommerce') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Styles & Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
@php
    use App\Models\ShoppingBag;

    if (auth()->check()) {
        $bagCount = ShoppingBag::where('user_id', auth()->id())->sum('quantity');
    } else {
        $bagCount = collect(session('bag'))->sum();
    }
@endphp
<body class="font-sans antialiased bg-gray-50 text-gray-900">
    <div class="min-h-screen flex flex-col">
        {{-- Navigation bar --}}
        @include('layouts.navigation')

        {{-- Page Heading --}}
        @isset($header)
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        {{-- Page Content --}}
        <main class="flex-grow">
            @yield('content')
        </main>
    </div>

    {{-- Script para persistência da bag --}}
    <script>
    document.addEventListener('DOMContentLoaded', () => {
        const sessionHasBag = {{ session()->has('bag') ? 'true' : 'false' }};
        const bag = JSON.parse(localStorage.getItem('bag')) || {};

        // Restaurar a bag após logout → envia e recarrega
        if (!sessionHasBag && Object.keys(bag).length > 0 && !sessionStorage.getItem('bagRestored')) {
            fetch('{{ route('bag.add') }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(bag)
            }).then(() => {
                // Marcar como restaurado para não entrar em loop
                sessionStorage.setItem('bagRestored', 'true');
                location.reload();
            });
        } else {
            // Limpa a flag ao navegar normalmente
            sessionStorage.removeItem('bagRestored');
        }

        // Salvar atualizações da bag no localStorage
        const bagForms = document.querySelectorAll('form[action="{{ route('bag.add') }}"]');
        bagForms.forEach(form => {
            form.addEventListener('submit', () => {
                const productId = form.querySelector('input[name="product_id"]').value;
                const quantityInput = form.querySelector('input[name="quantity"]');
                const quantity = quantityInput ? parseInt(quantityInput.value) : 1;

                bag[productId] = (bag[productId] || 0) + quantity;
                localStorage.setItem('bag', JSON.stringify(bag));
            });
        });

        // Limpar localStorage após finalizar pedido com sucesso
        if (window.location.pathname === '{{ route('checkout.success', [], false) }}') {
            localStorage.removeItem('bag');
            sessionStorage.removeItem('bagRestored');
        }
    });
    </script>
</body>
</html>
