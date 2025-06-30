@extends('admin.layouts.app')

@section('content')
<div class="bg-gray-100 min-h-screen py-12 px-6">
    <div class="max-w-6xl mx-auto">
        <h1 class="text-3xl font-bold text-gray-900 mb-4">Admin Dashboard</h1>
        <p class="text-gray-700">Welcome, {{ auth()->user()->name }}! You have admin access.</p>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 mt-8">
            <div class="bg-white p-6 rounded-lg shadow">
                <h2 class="text-lg font-semibold text-gray-800">Manage Products</h2>
                <p class="text-gray-600 mt-2">Create, edit, and organize your product catalog.</p>
            </div>

            <div class="bg-white p-6 rounded-lg shadow">
                <h2 class="text-lg font-semibold text-gray-800">View Orders</h2>
                <p class="text-gray-600 mt-2">Monitor sales and order status in real-time.</p>
            </div>

            <div class="bg-white p-6 rounded-lg shadow">
                <h2 class="text-lg font-semibold text-gray-800">Edit Pages</h2>
                <p class="text-gray-600 mt-2">Update About, Policies, and Help Center content.</p>
            </div>
        </div>
    </div>
</div>
@endsection
