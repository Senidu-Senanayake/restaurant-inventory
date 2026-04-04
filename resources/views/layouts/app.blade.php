<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Inventory System</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100">

<div class="flex h-screen">

    <div class="w-64 bg-gray-900 text-white flex flex-col">

        <div class="p-6 text-2xl font-bold border-b border-gray-700">
            Inventory
        </div>

        <nav class="flex-1 p-4 space-y-2">

            <a href="/dashboard" class="block px-4 py-2 rounded hover:bg-gray-700">
                Dashboard
            </a>

            <a href="/products" class="block px-4 py-2 rounded hover:bg-gray-700">
                Products
            </a>

            <a href="/stock" class="block px-4 py-2 rounded hover:bg-gray-700">
                Stock
            </a>

        </nav>

        <div class="p-4 border-t border-gray-700">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="w-full text-left px-4 py-2 hover:bg-gray-700 rounded">
                    Logout
                </button>
            </form>
        </div>

    </div>

    <div class="flex-1 flex flex-col">

        <header class="bg-white shadow px-6 py-4 flex justify-between items-center">

            <h1 class="text-xl font-semibold">
                @yield('title')
            </h1>

            <div>
                <span class="text-gray-600">
                    {{ auth()->user()->name }}
                </span>
            </div>

        </header>

        <main class="flex-1 p-6 overflow-y-auto">
            @yield('content')
        </main>

    </div>

</div>

</body>
</html>
