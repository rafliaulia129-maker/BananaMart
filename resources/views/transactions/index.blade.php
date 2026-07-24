<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Pesanan Saya - BananaMart</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="bg-[#F9E79F]">

<main class="max-w-6xl mx-auto px-4 py-10">

    <div class="flex justify-between items-center mb-8">

        <div>

            <h1 class="text-3xl font-bold text-[#7D6608]">
                Pesanan Saya
            </h1>

            <p class="text-[#9A7D0A] mt-2">
                Riwayat pemesanan pisang BananaMart
            </p>

        </div>

        <a href="{{ route('dashboard') }}"
           class="bg-[#D4AC0D] px-5 py-3 rounded-xl font-bold text-[#7D6608]">

            Dashboard

        </a>

    </div>

    @if(session('success'))

        <div class="mb-6 bg-[#FCF3CF] border border-[#D4AC0D] px-4 py-3 rounded-lg text-[#7D6608]">

            {{ session('success') }}

        </div>

    @endif

    <div class="bg-[#FCF3CF] border border-[#D4AC0D] rounded-2xl p-6 shadow-lg overflow-x-auto">

        <table class="w-full text-left">

            <thead>

                <tr class="border-b border-[#D4AC0D]">

                    <th class="py-3 text-[#7D6608]">
                        Nomor
                    </th>

                    <th class="py-3 text-[#7D6608]">
                        Produk
                    </th>

                    <th class="py-3 text-[#7D6608]">
                        Jumlah
                    </th>

                    <th class="py-3 text-[#7D6608]">
                        Total
                    </th>

                    <th class="py-3 text-[#7D6608]">
                        Status
                    </th>

                </tr>

            </thead>

            <tbody>

                @forelse($transactions as $transaction)

                    <tr class="border-b border-[#F4D03F]">

                        <td class="py-4 text-[#9A7D0A]">
                            {{ $transaction->transaction_number }}
                        </td>

                        <td class="py-4 text-[#9A7D0A]">
                            {{ $transaction->product_name }}
                        </td>

                        <td class="py-4 text-[#9A7D0A]">
                            {{ $transaction->quantity }}
                        </td>

                        <td class="py-4 text-[#9A7D0A]">
                            Rp {{ number_format($transaction->total_price, 0, ',', '.') }}
                        </td>

                        <td class="py-4 text-[#9A7D0A]">
                            {{ ucfirst($transaction->status) }}
                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="5"
                            class="py-8 text-center text-[#9A7D0A]">

                            Belum ada pesanan.

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</main>

</body>

</html>