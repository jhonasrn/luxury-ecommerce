<aside class="w-64 bg-white shadow h-screen fixed left-0 top-0 flex flex-col z-10">
    <div class="px-6 py-4 font-bold text-xl border-b">Admin CMS</div>
    <nav class="flex-1 p-4 space-y-1">
        <a href="{{ route('admin.dashboard') }}" class="block py-2 px-4 rounded hover:bg-gray-100">Dashboard</a>
        <a href="{{ route('admin.products.index') }}" class="block py-2 px-4 rounded hover:bg-gray-100">Products</a>
        <a href="{{ route('admin.orders.index') }}" class="block py-2 px-4 rounded hover:bg-gray-100">Orders</a>
        <a href="{{ route('admin.users.index') }}" class="block py-2 px-4 rounded hover:bg-gray-100">Users</a>
        <!-- <a href="{{ route('admin.reports.index') }}" class="block py-2 px-4 rounded hover:bg-gray-100">Reports</a> -->
    </nav>
</aside>
