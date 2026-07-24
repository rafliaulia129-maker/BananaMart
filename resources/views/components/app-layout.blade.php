<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 text-gray-900">
    <nav class="bg-white shadow px-6 py-4 flex justify-between items-center">
        <div class="flex items-center gap-6">
            <a href="{{ route('dashboard') }}" class="font-bold text-lg">BananaMart</a>
            <a href="{{ route('dashboard') }}" class="text-gray-700 hover:text-black">Dashboard</a>
            <a href="{{ route('products.index') }}" class="text-gray-700 hover:text-black">Produk</a>
            <a href="{{ route('transactions.index') }}" class="text-gray-700 hover:text-black">Transaksi</a>
        </div>

        <div class="flex items-center gap-4">
            <span>{{ Auth::user()->name ?? 'User' }}</span>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="text-red-600">Logout</button>
            </form>
        </div>
    </nav>

    <main class="py-8">
        {{ $slot }}
    </main>
</body>
</html>