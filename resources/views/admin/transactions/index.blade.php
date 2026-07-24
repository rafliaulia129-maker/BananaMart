<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Transaksi - BananaMart</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#F9E79F]">

    <nav class="bg-[#F4D03F] border-b border-[#D4AC0D]">
        <div class="max-w-7xl mx-auto flex justify-between items-center px-6 py-4">
            <div>
                <h1 class="text-3xl font-bold text-[#7D6608]">🍌 BananaMart</h1>
                <p class="text-[#9A7D0A]">Kelola Transaksi Admin</p>
            </div>

            <div class="flex items-center gap-4">
                <a href="{{ route('dashboard') }}"
                   class="bg-white px-4 py-2 rounded-lg font-bold text-[#7D6608]">
                    Dashboard
                </a>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="bg-[#D4AC0D] px-4 py-2 rounded-lg font-bold text-[#7D6608]">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-4 py-10">
        <div class="flex flex-wrap justify-between items-center gap-4 mb-8">
            <div>
                <h1 class="text-3xl font-bold text-[#7D6608]">Data Transaksi</h1>
                <p class="text-[#9A7D0A] mt-2">Kelola seluruh transaksi jual beli pisang</p>
            </div>

            <div class="flex gap-3">
                <a href="{{ route('dashboard') }}"
                   class="bg-[#F4D03F] px-5 py-3 rounded-xl font-bold text-[#7D6608]">
                    Dashboard
                </a>

                @if (Route::has('reports.export.excel'))
                    <a href="{{ route('reports.export.excel') }}"
                       class="bg-[#D4AC0D] px-5 py-3 rounded-xl font-bold text-[#7D6608]">
                        Export Excel
                    </a>
                @endif
            </div>
        </div>

        <form method="GET" action="{{ route('admin.transactions.index') }}"
              class="mb-6 grid gap-4 md:grid-cols-4 bg-[#FCF3CF] border border-[#D4AC0D] rounded-2xl p-4">
            <div>
                <label class="mb-2 block font-semibold text-[#7D6608]">Status Pesanan</label>
                <select name="status" class="w-full rounded-lg border-[#D4AC0D] bg-[#F9E79F] text-[#7D6608]">
                    <option value="">Semua</option>
                    <option value="pending" @selected(request('status') === 'pending')>Pending</option>
                    <option value="processing" @selected(request('status') === 'processing')>Processing</option>
                    <option value="completed" @selected(request('status') === 'completed')>Completed</option>
                    <option value="cancelled" @selected(request('status') === 'cancelled')>Cancelled</option>
                </select>
            </div>

            <div>
                <label class="mb-2 block font-semibold text-[#7D6608]">Status Pembayaran</label>
                <select name="payment_status" class="w-full rounded-lg border-[#D4AC0D] bg-[#F9E79F] text-[#7D6608]">
                    <option value="">Semua</option>
                    <option value="waiting" @selected(request('payment_status') === 'waiting')>Waiting</option>
                    <option value="unpaid" @selected(request('payment_status') === 'unpaid')>Unpaid</option>
                    <option value="paid" @selected(request('payment_status') === 'paid')>Paid</option>
                </select>
            </div>

            <div class="flex items-end">
                <button type="submit"
                        class="w-full rounded-xl bg-[#D4AC0D] px-4 py-3 font-bold text-white hover:bg-[#B7950B]">
                    Filter
                </button>
            </div>

            <div class="flex items-end">
                <a href="{{ route('admin.transactions.index') }}"
                   class="w-full rounded-xl bg-gray-200 px-4 py-3 text-center font-bold text-gray-700 hover:bg-gray-300">
                    Reset
                </a>
            </div>
        </form>

        @if(session('success'))
            <div class="mb-6 bg-[#FCF3CF] border border-[#D4AC0D] px-4 py-3 rounded-xl text-[#7D6608]">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-6 rounded-xl border border-red-300 bg-red-100 px-4 py-3 text-red-700">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="bg-[#FCF3CF] border border-[#D4AC0D] rounded-2xl shadow-lg overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="border-b border-[#D4AC0D]">
                        <th class="p-4 text-[#7D6608]">Nomor Transaksi</th>
                        <th class="p-4 text-[#7D6608]">User</th>
                        <th class="p-4 text-[#7D6608]">Produk</th>
                        <th class="p-4 text-[#7D6608]">Jumlah</th>
                        <th class="p-4 text-[#7D6608]">Total</th>
                        <th class="p-4 text-[#7D6608]">Metode</th>
                        <th class="p-4 text-[#7D6608]">Status Bayar</th>
                        <th class="p-4 text-[#7D6608]">Bukti</th>
                        <th class="p-4 text-[#7D6608]">Status Pesanan</th>
                        <th class="p-4 text-[#7D6608]">Struk</th>
                        <th class="p-4 text-[#7D6608]">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($transactions as $transaction)
                        <tr class="border-b border-[#F4D03F] align-top">
                            <td class="p-4 text-[#9A7D0A]">{{ $transaction->transaction_number }}</td>
                            <td class="p-4 text-[#9A7D0A]">{{ $transaction->user->name ?? 'User tidak ditemukan' }}</td>
                            <td class="p-4 text-[#9A7D0A]">{{ $transaction->product_name }}</td>
                            <td class="p-4 text-[#9A7D0A]">{{ $transaction->quantity }}</td>
                            <td class="p-4 text-[#9A7D0A]">Rp {{ number_format($transaction->total_price, 0, ',', '.') }}</td>
                            <td class="p-4 text-[#9A7D0A]">{{ strtoupper(str_replace('_', ' ', $transaction->payment_method ?? '-')) }}</td>

                            <td class="p-4">
                                @php
                                    $paymentBadge = match($transaction->payment_status) {
                                        'paid' => 'bg-green-100 text-green-700',
                                        'waiting' => 'bg-yellow-100 text-yellow-700',
                                        'unpaid' => 'bg-red-100 text-red-700',
                                        default => 'bg-gray-100 text-gray-700',
                                    };
                                @endphp
                                <span class="inline-flex rounded-full px-3 py-1 text-sm font-semibold {{ $paymentBadge }}">
                                    {{ ucfirst($transaction->payment_status ?? '-') }}
                                </span>
                            </td>

                            <td class="p-4 text-[#9A7D0A]">
                                @if ($transaction->payment_proof)
                                    <a href="{{ asset('storage/' . $transaction->payment_proof) }}"
                                       target="_blank"
                                       class="text-blue-600 underline">
                                        Lihat Bukti
                                    </a>
                                @else
                                    <span>-</span>
                                @endif
                            </td>

                            <td class="p-4">
                                @php
                                    $orderBadge = match($transaction->status) {
                                        'completed' => 'bg-green-100 text-green-700',
                                        'processing' => 'bg-blue-100 text-blue-700',
                                        'pending' => 'bg-yellow-100 text-yellow-700',
                                        'cancelled' => 'bg-red-100 text-red-700',
                                        default => 'bg-gray-100 text-gray-700',
                                    };
                                @endphp
                                <span class="inline-flex rounded-full px-3 py-1 text-sm font-semibold {{ $orderBadge }}">
                                    {{ ucfirst($transaction->status) }}
                                </span>
                            </td>

                            <td class="p-4">
                                <a href="{{ route('transactions.show', $transaction) }}"
                                   target="_blank"
                                   class="inline-flex rounded-lg bg-[#F4D03F] px-3 py-2 font-semibold text-[#7D6608] hover:bg-[#D4AC0D]">
                                    Lihat Struk
                                </a>
                            </td>

                            <td class="p-4">
                                <form method="POST" action="{{ route('admin.transactions.status', $transaction) }}" class="space-y-2">
                                    @csrf
                                    @method('PATCH')

                                    <select name="status" class="w-full rounded-lg border-[#D4AC0D] bg-[#F9E79F] text-[#7D6608]">
                                        <option value="pending" @selected($transaction->status === 'pending')>Pending</option>
                                        <option value="processing" @selected($transaction->status === 'processing')>Processing</option>
                                        <option value="completed" @selected($transaction->status === 'completed')>Completed</option>
                                        <option value="cancelled" @selected($transaction->status === 'cancelled')>Cancelled</option>
                                    </select>

                                    <select name="payment_status" class="w-full rounded-lg border-[#D4AC0D] bg-[#F9E79F] text-[#7D6608]">
                                        <option value="waiting" @selected($transaction->payment_status === 'waiting')>Waiting</option>
                                        <option value="unpaid" @selected($transaction->payment_status === 'unpaid')>Unpaid</option>
                                        <option value="paid" @selected($transaction->payment_status === 'paid')>Paid</option>
                                    </select>

                                    <button type="submit"
                                            class="w-full rounded-lg bg-[#D4AC0D] px-3 py-2 font-semibold text-white hover:bg-[#B7950B]">
                                        Update
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="11" class="p-8 text-center text-[#9A7D0A]">
                                Belum ada transaksi.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            {{ $transactions->links() }}
        </div>
    </main>

</body>
</html>