<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Painel Admin')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css') {{-- ou use CDN do Tailwind se preferir --}}
</head>
<body class="bg-gray-100 font-sans antialiased">

    <div class="flex min-h-screen">
        {{-- Sidebar --}}
        @include('admin.components.sidebar')

        <div class="flex-1 flex flex-col">
            {{-- Header --}}
            @include('admin.components.header')

            {{-- Main content --}}
            <main class="p-6">
                @yield('content')
            </main>
        </div>
    </div>

</body>
</html>
