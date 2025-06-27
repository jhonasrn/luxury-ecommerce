<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Se estiver usando Vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 font-sans antialiased">
    <div class="min-h-screen">
        {{-- Menu de navegação (se tiver) --}}
        @include('layouts.navigation')

        {{-- Conteúdo principal --}}
        <main class="py-8">
            {{ $slot }}
        </main>
    </div>
</body>
</html>
