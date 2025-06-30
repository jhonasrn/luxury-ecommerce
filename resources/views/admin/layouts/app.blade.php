<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Painel Admin')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css') {{-- ou use CDN do Tailwind se preferir --}}
</head>
<body class="bg-gray-100 font-sans antialiased">

    {{-- Sidebar fixo --}}
    @include('admin.components.sidebar')

    {{-- Conteúdo principal com padding compensando o menu lateral --}}
    <div class="pl-64 min-h-screen flex flex-col">
        {{-- Header (fixo ou não, dependendo do estilo) --}}
        @include('admin.components.header')

        {{-- Main content --}}
        <main class="p-6">
            @yield('content')
        </main>
    </div>

</body>
</html>
