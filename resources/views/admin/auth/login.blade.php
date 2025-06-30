@extends('admin.layouts.guest')

@section('title', 'Login Administrador')

@section('content')
<div class="max-w-md mx-auto bg-white p-8 mt-6 rounded shadow">
    <h2 class="text-2xl font-bold mb-6 text-center">Login Administrador</h2>

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ route('admin.login.submit') }}">
        @csrf

        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Email</label>
            <input type="email" name="email" class="w-full border p-2 rounded" required autofocus>
        </div>

        <div class="mb-6">
            <label class="block text-sm font-medium mb-1">Senha</label>
            <input type="password" name="password" class="w-full border p-2 rounded" required>
        </div>

        <button class="w-full bg-gray-800 text-white py-2 px-4 rounded hover:bg-gray-700">
            Entrar
        </button>
    </form>
</div>
@endsection
