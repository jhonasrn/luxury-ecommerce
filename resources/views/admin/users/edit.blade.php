@extends('admin.layouts.app')

@section('title', 'Edit User #' . $user->id)

@section('content')
<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
    <h1 class="text-2xl font-bold text-gray-900 mb-6">Edit User #{{ $user->id }}</h1>

    <!-- Flash message -->
    @if(session('success'))
        <div class="bg-green-100 text-green-800 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <!-- User Edit Form -->
    <form method="POST" action="{{ route('admin.users.update', $user) }}" class="bg-white shadow rounded-lg p-6 mb-10">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Name -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Name</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}"
                       class="mt-1 block w-full border-gray-300 rounded shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>

            <!-- Email -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}"
                       class="mt-1 block w-full border-gray-300 rounded shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>

            <!-- New Password -->
            <div>
                <label class="block text-sm font-medium text-gray-700">New Password</label>
                <input type="password" name="password"
                       class="mt-1 block w-full border-gray-300 rounded shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                       placeholder="Leave blank to keep current password">
            </div>

            <!-- Confirm Password -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Confirm Password</label>
                <input type="password" name="password_confirmation"
                       class="mt-1 block w-full border-gray-300 rounded shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>

            <!-- Role -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Role</label>
                <select name="role"
                        class="mt-1 block w-full border-gray-300 rounded shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>User</option>
                    <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                </select>
            </div>

            <!-- Status -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Status</label>
                <select name="status"
                        class="mt-1 block w-full border-gray-300 rounded shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <option value="pending" {{ $user->status === 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="active" {{ $user->status === 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ $user->status === 'inactive' ? 'selected' : '' }}>Inactive</option>
                    <option value="deleted" {{ $user->status === 'deleted' ? 'selected' : '' }}>Deleted</option>
                </select>
            </div>
        </div>
        <div class="mt-6 flex gap-3">
            <button type="submit"
                    class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-500 transition">
                Save Changes
            </button>

            <a href="{{ route('admin.users.index') }}"
            class="bg-gray-100 text-gray-800 px-4 py-2 rounded hover:bg-gray-200 transition">
                Cancel
            </a>
        </div>
    </form>

    <!-- Used Addresses -->
    <div class="mb-10">
        <h2 class="text-lg font-semibold text-gray-800 mb-4">Used Shipping Addresses</h2>
        <div class="bg-white shadow rounded-lg p-4 space-y-2 text-sm text-gray-700">
            @forelse($addresses as $address)
                <div class="border-b pb-2">{{ $address }}</div>
            @empty
                <p>No addresses found.</p>
            @endforelse
        </div>
    </div>

    <!-- Order History -->
    <div>
        <h2 class="text-lg font-semibold text-gray-800 mb-4">Order History</h2>
        <div class="bg-white shadow rounded-lg overflow-hidden">
            <table class="min-w-full table-auto text-sm">
                <thead class="bg-gray-100 text-left text-gray-600 uppercase">
                    <tr>
                        <th class="px-6 py-3">Order ID</th>
                        <th class="px-6 py-3">Status</th>
                        <th class="px-6 py-3">Total</th>
                        <th class="px-6 py-3">Created At</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($orders as $order)
                        <tr>
                            <td class="px-6 py-4">#{{ $order->id }}</td>
                            <td class="px-6 py-4 capitalize">{{ $order->status }}</td>
                            <td class="px-6 py-4">${{ number_format($order->total, 2) }}</td>
                            <td class="px-6 py-4">{{ $order->created_at->format('d M Y, H:i') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-4 text-center text-gray-500">No orders found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
