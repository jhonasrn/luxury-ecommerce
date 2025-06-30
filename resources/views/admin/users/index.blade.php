@extends('admin.layouts.app')

@section('title', 'Users')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Users</h1>
        <a href="{{ route('admin.users.create') }}"
           class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-500 transition">
            + New User
        </a>
    </div>

    <!-- Filters and Search -->
    <form method="GET" action="{{ route('admin.users.index') }}" class="mb-4">
        <div class="flex flex-wrap gap-4 items-end">
            <!-- Text search -->
            <div class="flex-1 min-w-[200px]">
                <label for="search" class="block text-sm font-medium text-gray-700">Search</label>
                <input type="text" name="search" id="search" value="{{ request('search') }}"
                    placeholder="Name or email"
                    class="mt-1 w-full border-gray-300 rounded shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>

            <!-- Status filter -->
            <div class="min-w-[160px]">
                <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                <select name="status" id="status"
                        class="mt-1 w-full border-gray-300 rounded shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <option value="">All</option>
                    <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Inactive</option>
                    <option value="deleted" {{ request('status') === 'deleted' ? 'selected' : '' }}>Deleted</option>
                </select>
            </div>

            <!-- Submit button -->
            <div>
                <button type="submit"
                        class="bg-gray-100 text-gray-800 px-4 py-2 rounded hover:bg-gray-200 transition">
                    Filter
                </button>
            </div>
        </div>
    </form>


    <!-- Flash message -->
    @if(session('success'))
        <div class="bg-green-100 text-green-800 px-4 py-3 mb-4 rounded">
            {{ session('success') }}
        </div>
    @endif

    <!-- Users Table -->
    <div class="bg-white shadow rounded-lg overflow-hidden">
        <table class="min-w-full table-auto">
            <thead class="bg-gray-100 text-left text-gray-600 uppercase text-sm">
                <tr>
                    <th class="px-6 py-3">#</th>
                    <th class="px-6 py-3">Name</th>
                    <th class="px-6 py-3">Email</th>
                    <th class="px-6 py-3">Status</th>
                    <th class="px-6 py-3">Registered</th>
                    <th class="px-6 py-3">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 text-sm">
                @foreach($users as $user)
                    <tr>
                        <td class="px-6 py-4">{{ $user->id }}</td>
                        <td class="px-6 py-4">{{ $user->name }}</td>
                        <td class="px-6 py-4">{{ $user->email }}</td>
                        <td class="px-6 py-4">
                            <span class="inline-block px-2 py-1 text-xs rounded-full
                                @if($user->status === 'active') bg-green-100 text-green-800
                                @elseif($user->status === 'inactive') bg-yellow-100 text-yellow-800
                                @elseif($user->status === 'deleted') bg-red-100 text-red-800
                                @else bg-gray-100 text-gray-800
                                @endif">
                                {{ ucfirst($user->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4">{{ $user->created_at->format('d M Y, H:i') }}</td>
                        <td class="px-6 py-4">
                            <a href="{{ route('admin.users.edit', $user) }}"
                               class="text-indigo-600 hover:text-indigo-900 text-sm font-medium">
                                Edit
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $users->appends(request()->query())->links() }}
    </div>
</div>
@endsection
