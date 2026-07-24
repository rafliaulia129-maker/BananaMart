<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard BananaMart</title>

    @vite(['resources/css/app.css','resources/js/app.js'])
</head>

<body class="bg-[#F9E79F]">

<nav class="bg-[#F4D03F] border-b border-[#D4AC0D]">

    <div class="max-w-7xl mx-auto flex justify-between items-center px-6 py-4">

        <div>

            <h1 class="text-3xl font-bold text-[#7D6608]">
                🍌 BananaMart
            </h1>

            <p class="text-[#9A7D0A]">
                Sistem Jual Beli Pisang
            </p>

        </div>

        <div class="flex items-center gap-4">

            <span class="font-bold text-[#7D6608]">

                {{ auth()->user()->name }}

            </span>

            <form action="{{ route('logout') }}" method="POST">

                @csrf

                <button class="bg-[#D4AC0D] px-4 py-2 rounded-lg font-bold">

                    Logout

                </button>

            </form>

        </div>

    </div>

</nav>


<div class="max-w-7xl mx-auto p-8">

@if(auth()->user()->isAdmin())

<!-- ================= ADMIN ================= -->

<h1 class="text-4xl font-bold text-[#7D6608] mb-8">

Dashboard Admin

</h1>

<div class="grid md:grid-cols-4 gap-6">

    <div class="bg-white rounded-xl shadow-lg p-6">

        <h3 class="text-gray-500">
            Produk
        </h3>

        <p class="text-4xl font-bold">

            {{ $totalProducts }}

        </p>

    </div>

    <div class="bg-white rounded-xl shadow-lg p-6">

        <h3 class="text-gray-500">
            User
        </h3>

        <p class="text-4xl font-bold">

            {{ $totalUsers }}

        </p>

    </div>

    <div class="bg-white rounded-xl shadow-lg p-6">

        <h3 class="text-gray-500">
            Transaksi
        </h3>

        <p class="text-4xl font-bold">

            {{ $totalTransactions }}

        </p>

    </div>

    <div class="bg-white rounded-xl shadow-lg p-6">

        <h3 class="text-gray-500">
            Penjualan
        </h3>

        <p class="text-2xl font-bold">

            Rp {{ number_format($totalSales,0,',','.') }}

        </p>

    </div>

</div>


<<div class="flex gap-4 mt-8 flex-wrap">
    <a href="{{ route('products.create') }}"
       class="bg-yellow-400 px-5 py-3 rounded-xl font-bold text-[#7D6608] hover:bg-yellow-500">
        Tambah Produk
    </a>

    <a href="{{ route('products.index') }}"
       class="bg-[#F7DC6F] px-5 py-3 rounded-xl font-bold text-[#7D6608] hover:bg-[#F4D03F]">
        Lihat Produk
    </a>

    <a href="{{ route('admin.transactions.index') }}"
       class="bg-green-400 px-5 py-3 rounded-xl font-bold text-[#7D6608] hover:bg-green-500">
        Kelola Transaksi
    </a>

    <a href="{{ route('reports.export.excel') }}"
   class="bg-blue-400 px-5 py-3 rounded-xl font-bold text-[#7D6608] hover:bg-blue-500">
    Export Laporan
</a>
</div>

<hr class="my-10">

<h2 class="text-2xl font-bold mb-5">

Transaksi Terbaru

</h2>

<table class="w-full bg-white shadow rounded-xl">

<thead>

<tr class="border-b">

<th class="p-3">Nomor</th>
<th class="p-3">User</th>
<th class="p-3">Produk</th>
<th class="p-3">Total</th>
<th class="p-3">Status</th>

</tr>

</thead>

<tbody>

@forelse($latestTransactions as $transaction)

<tr>

<td class="p-3">

{{ $transaction->transaction_number }}

</td>

<td class="p-3">

{{ $transaction->user->name }}

</td>

<td class="p-3">

{{ $transaction->product_name }}

</td>

<td class="p-3">

Rp {{ number_format($transaction->total_price,0,',','.') }}

</td>

<td class="p-3">

{{ ucfirst($transaction->status) }}

</td>

</tr>

@empty

<tr>

<td colspan="5" class="text-center p-5">

Belum ada transaksi.

</td>

</tr>

@endforelse

</tbody>

</table>

@else

<!-- ================= USER ================= -->

<div class="bg-white rounded-2xl shadow-lg p-8">

<h1 class="text-4xl font-bold text-[#7D6608]">

Selamat Datang, {{ auth()->user()->name }}

</h1>

<p class="mt-3 text-gray-600">

Silakan pilih produk pisang yang ingin dibeli.

</p>

<a href="{{ route('transactions.index') }}"
class="inline-block mt-5 bg-yellow-400 px-5 py-3 rounded-xl font-bold">

Lihat Pesanan Saya

</a>

</div>

<div class="grid md:grid-cols-3 gap-8 mt-10">

@forelse($products as $product)

<div class="bg-white rounded-xl shadow-lg overflow-hidden">

@if($product->image)

<img src="{{ asset('storage/'.$product->image) }}"
class="w-full h-56 object-cover">

@else

<div class="h-56 bg-yellow-200 flex items-center justify-center text-6xl">

🍌

</div>

@endif

<div class="p-5">

<h2 class="text-2xl font-bold">

{{ $product->name }}

</h2>

<p class="text-gray-500 mt-2">

{{ $product->description }}

</p>

<p class="text-2xl font-bold mt-4">

Rp {{ number_format($product->price,0,',','.') }}

</p>

<p class="mt-2">

Jenis :

{{ $product->type }}

</p>

<p>

Berat :

{{ $product->weight }} Kg

</p>

<p>

Stok :

{{ $product->stock }}

</p>

@if($product->stock > 0)

<a href="{{ route('transactions.create',$product) }}"
class="block mt-5 bg-yellow-400 py-3 rounded-lg text-center font-bold">

🍌 Beli Sekarang

</a>

@else

<button
class="block w-full mt-5 bg-gray-300 py-3 rounded-lg">

Stok Habis

</button>

@endif

</div>

</div>

@empty

<div class="col-span-3 text-center text-2xl">

Belum ada produk.

</div>

@endforelse

</div>

@endif

</div>

</body>

</html>