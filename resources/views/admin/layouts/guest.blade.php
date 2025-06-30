<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Login Administrador')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Styles & Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 font-sans antialiased text-gray-900">
    <div class="min-h-screen flex flex-col justify-center items-center">
        <div class="text-center mb-6">
            <h1 class="text-3xl font-bold text-gray-800 tracking-wide">LuxuryStore Admin</h1>
            <p class="text-sm text-gray-500 mt-1">Área administrativa — login necessário</p>
        </div>

        <div class="w-full sm:max-w-md px-6 py-8 bg-white shadow-md sm:rounded-lg">
            @yield('content')
        </div>
    </div>
</body>
</html>
