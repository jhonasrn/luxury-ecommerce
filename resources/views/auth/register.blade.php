@extends('layouts.app')

<!-- @if ($errors->any())
    <div class="text-red-500 text-sm mb-4">
        <ul>
            @foreach ($errors->all() as $error)
                <li>• {{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif -->

@section('content')
<div class="flex justify-center items-center min-h-screen bg-gray-100">
    <div class="w-full max-w-md bg-white p-10 rounded-lg shadow-md">
        <h2 class="text-2xl font-semibold text-center text-gray-800 mb-6">Create Account</h2>

        <form method="POST" action="{{ route('register') }}" class="space-y-4">
            @csrf

            <!-- Name -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                <input type="text" name="name" id="name" required autofocus
                    class="mt-1 w-full border border-gray-300 rounded-md px-4 py-2 text-sm shadow-sm focus:outline-none focus:ring focus:ring-gray-400" />
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email" required
                    class="mt-1 w-full border border-gray-300 rounded-md px-4 py-2 text-sm shadow-sm focus:outline-none focus:ring focus:ring-gray-400" />
                @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" name="password" id="password" required
                    class="mt-1 w-full border border-gray-300 rounded-md px-4 py-2 text-sm shadow-sm focus:outline-none focus:ring focus:ring-gray-400" />
                
                <!-- Informative hint -->
                <p class="text-gray-500 text-xs mt-1">
                    Must be at least 8 characters and include uppercase, lowercase, a number, and a symbol.
                </p>

                @error('password')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" required
                    class="mt-1 w-full border border-gray-300 rounded-md px-4 py-2 text-sm shadow-sm focus:outline-none focus:ring focus:ring-gray-400" />
                @error('password_confirmation')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <button type="submit"
                    class="w-full bg-gray-800 text-white py-2 rounded-md text-sm hover:bg-gray-900 transition">
                    Register
                </button>
            </div>
        </form>

        <p class="text-center text-sm text-gray-600 mt-4">
            Already have an account?
            <a href="{{ route('login') }}" class="text-gray-800 hover:underline">Log in</a>
        </p>
    </div>
</div>
@endsection
