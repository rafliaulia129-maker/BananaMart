@extends('layouts.app')

@section('content')
<div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-8">
    <div>
        <h1 class="text-3xl font-bold text-[#7D6608]">
            Produk Pisang
        </h1>

        <p class="text-[#9A7D0A] mt-2">
            Kelola produk pisang BananaMart
        </p>
    </div>

    @auth
        @if(auth()->user()->role === 'admin')
            <a href="{{ route('products.create') }}"
               class="bg-[#D4AC0D] px-5 py-3 rounded-xl font-bold text-[#7D6608] hover:bg-yellow-400 transition">
                + Tambah Produk
            </a>
        @endif
    @endauth
</div>

@if(session('success'))
    <div class="mb-6 rounded-xl bg-green-100 border border-green-300 px-4 py-3 text-green-800">
        {{ session('success') }}
    </div>
@endif

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
    @forelse($products as $product)
        <div class="bg-[#FCF3CF] border border-[#D4AC0D] rounded-2xl overflow-hidden shadow-lg">
            @if($product->image)
                <img
                    src="{{ asset('storage/' . $product->image) }}"
                    alt="{{ $product->name }}"
                    class="w-full h-48 object-cover"
                >
            @else
                <div class="w-full h-48 bg-[#F4D03F] flex items-center justify-center">
                    <span class="text-6xl">🍌</span>
                </div>
            @endif

            <div class="p-5">
                <div class="flex justify-between items-start gap-2">
                    <h2 class="text-xl font-bold text-[#7D6608]">
                        {{ $product->name }}
                    </h2>

                    <span class="text-xs font-bold text-[#9A7D0A]">
                        {{ $product->status === 'available' ? 'Tersedia' : 'Habis' }}
                    </span>
                </div>

                <p class="text-[#9A7D0A] mt-1">
                    {{ $product->type ?? '-' }}
                </p>

                <p class="text-lg font-bold text-[#7D6608] mt-4">
                    Rp {{ number_format($product->price, 0, ',', '.') }}
                </p>

                <p class="text-sm text-[#9A7D0A] mt-2">
                    Stok: {{ $product->stock }} | {{ $product->weight ?? 0 }} Kg
                </p>

                <div class="flex gap-2 mt-5">
                    <a href="{{ route('products.show', $product->id) }}"
                       class="flex-1 text-center bg-[#F4D03F] py-2 rounded-lg font-semibold text-[#7D6608] hover:bg-yellow-300 transition">
                        Detail
                    </a>

                    @auth
                        @if(auth()->user()->role === 'admin')
                            <a href="{{ route('products.edit', $product->id) }}"
                               class="flex-1 text-center bg-[#D4AC0D] py-2 rounded-lg font-semibold text-[#7D6608] hover:bg-yellow-400 transition">
                                Edit
                            </a>
                        @else
                            <a href="{{ route('transactions.create', $product->id) }}"
                               class="flex-1 text-center bg-[#D4AC0D] py-2 rounded-lg font-semibold text-[#7D6608] hover:bg-yellow-400 transition">
                                🛒 Beli
                            </a>
                        @endif
                    @endauth
                </div>

                @auth
                    @if(auth()->user()->role === 'admin')
                        <form method="POST"
                              action="{{ route('products.destroy', $product->id) }}"
                              class="mt-2">
                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                    onclick="return confirm('Yakin ingin menghapus produk ini?')"
                                    class="w-full bg-[#B7950B] py-2 rounded-lg font-semibold text-[#7D6608] hover:bg-yellow-600 transition">
                                Hapus Produk
                            </button>
                        </form>
                    @endif
                @endauth
            </div>
        </div>
    @empty
        <div class="col-span-full bg-[#FCF3CF] border border-[#D4AC0D] rounded-2xl p-10 text-center">
            <div class="text-6xl mb-4">🍌</div>

            <h2 class="text-2xl font-bold text-[#7D6608]">
                Belum Ada Produk
            </h2>

            <p class="text-[#9A7D0A] mt-2">
                Silakan tambahkan produk pisang pertama.
            </p>
        </div>
    @endforelse
</div>

<div class="mt-8">
    {{ $products->links() }}
</div>
@endsection