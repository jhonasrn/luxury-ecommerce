<header class="bg-white p-4 shadow pl-72">
    <div class="flex justify-between items-center">
        <h2 class="text-xl font-semibold">Dashboard</h2>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="text-sm text-red-600 hover:underline">Sair</button>
        </form>
    </div>
</header>
