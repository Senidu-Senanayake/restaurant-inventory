<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Inventory System</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100">

<div class="flex h-screen">

    <!-- SIDEBAR -->
    <div class="inventory-sidebar flex h-full w-64 shrink-0 flex-col">

        <div class="inventory-sidebar__brand p-6 text-2xl font-bold">
            Inventory
        </div>

        <nav class="flex-1 space-y-2 p-4">

            <a href="{{ route('dashboard') }}" class="block rounded px-4 py-2">
                Dashboard
            </a>

            <a href="{{ route('products.index') }}" class="block rounded px-4 py-2">
                Products
            </a>

            <a href="{{ route('stock.index') }}" class="block rounded px-4 py-2">
                Stock
            </a>

        </nav>

        <div class="inventory-sidebar__footer p-4">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full rounded px-4 py-2 text-left">
                    Logout
                </button>
            </form>
        </div>

    </div>

    <!-- MAIN CONTENT -->
    <div class="flex-1 flex flex-col">

        <!-- TOP HEADER -->
        <header class="bg-white shadow px-6 py-4 flex justify-between items-center">

            <h1 class="text-xl font-semibold">
                {{ $header ?? 'Dashboard' }}
            </h1>

            <div>
                <span class="text-gray-600">
                    {{ auth()->user()?->name }}
                </span>
            </div>

        </header>

        <!-- PAGE CONTENT -->
        <main class="flex-1 p-6 overflow-y-auto">
            {{ $slot }}
        </main>

    </div>

</div>

</body>
</html>
