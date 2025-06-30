@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

    <h1 class="text-2xl font-bold text-gray-900 mb-4">Admin Dashboard</h1>

    <!-- Orders by status -->
    <div>
        <h2 class="text-lg font-semibold text-gray-800 mb-2">Orders by Status</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
            @foreach($orderCountsByStatus as $status => $count)
                <div class="bg-white shadow rounded-lg p-4 text-center">
                    <p class="text-gray-500 uppercase text-sm font-medium">{{ ucfirst($status) }}</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $count }}</p>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Users by status -->
    <div>
        <h2 class="text-lg font-semibold text-gray-800 mb-2">Users by Status</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
            @foreach($userCountsByStatus as $status => $count)
                <div class="bg-white shadow rounded-lg p-4 text-center">
                    <p class="text-gray-500 uppercase text-sm font-medium">{{ ucfirst($status) }}</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $count }}</p>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Orders by time -->
    <div>
        <h2 class="text-lg font-semibold text-gray-800 mb-2">Orders placed today, this week, this month</h2>
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <div class="bg-white shadow rounded-lg p-4 text-center">
                <p class="text-gray-500 uppercase text-sm font-medium">Today</p>
                <p class="text-2xl font-bold text-gray-900">{{ $ordersToday }}</p>
            </div>
            <div class="bg-white shadow rounded-lg p-4 text-center">
                <p class="text-gray-500 uppercase text-sm font-medium">This Week</p>
                <p class="text-2xl font-bold text-gray-900">{{ $ordersThisWeek }}</p>
            </div>
            <div class="bg-white shadow rounded-lg p-4 text-center">
                <p class="text-gray-500 uppercase text-sm font-medium">This Month</p>
                <p class="text-2xl font-bold text-gray-900">{{ $ordersThisMonth }}</p>
            </div>
        </div>
    </div>

</div>
@endsection
