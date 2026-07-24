<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard Admin - BananaMart</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#F9E79F]">

    <div class="min-h-screen">

        <nav class="bg-[#F4D03F] border-b border-[#D4AC0D]">
            <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">

                <h1 class="text-2xl font-bold text-[#7D6608]">
                    BananaMart
                </h1>

                <div class="flex items-center gap-4">

                    <span class="font-semibold text-[#7D6608]">
                        {{ auth()->user()->name }}
                    </span>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <button
                            class="bg-[#D4AC0D] px-4 py-2 rounded-lg font-semibold text-[#7D6608] hover:bg-[#B7950B]">
                            Logout
                        </button>
                    </form>

                </div>

            </div>
        </nav>

        <main class="max-w-7xl mx-auto px-4 py-8">

            <div class="mb-8">
                <h2 class="text-3xl font-bold text-[#7D6608]">
                    Dashboard Admin
                </h2>

                <p class="text-[#9A7D0A]">
                    Kelola perusahaan jual beli pisang BananaMart
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

                <div class="bg-[#FCF3CF] rounded-2xl p-6 shadow-lg border border-[#D4AC0D]">
                    <p class="text-[#9A7D0A]">
                        Total Produk
                    </p>

                    <h3 class="text-3xl font-bold text-[#7D6608] mt-2">
                        0
                    </h3>
                </div>

                <div class="bg-[#FCF3CF] rounded-2xl p-6 shadow-lg border border-[#D4AC0D]">
                    <p class="text-[#9A7D0A]">
                        Total User
                    </p>

                    <h3 class="text-3xl font-bold text-[#7D6608] mt-2">
                        0
                    </h3>
                </div>

                <div class="bg-[#FCF3CF] rounded-2xl p-6 shadow-lg border border-[#D4AC0D]">
                    <p class="text-[#9A7D0A]">
                        Total Transaksi
                    </p>

                    <h3 class="text-3xl font-bold text-[#7D6608] mt-2">
                        0
                    </h3>
                </div>

                <div class="bg-[#FCF3CF] rounded-2xl p-6 shadow-lg border border-[#D4AC0D]">
                    <p class="text-[#9A7D0A]">
                        Total Penjualan
                    </p>

                    <h3 class="text-3xl font-bold text-[#7D6608] mt-2">
                        Rp 0
                    </h3>
                </div>

            </div>

        </main>

    </div>

</body>
</html>