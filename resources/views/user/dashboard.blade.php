<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>BananaMart</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#F9E79F]">

    <nav class="bg-[#F4D03F] border-b border-[#D4AC0D]">
        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">

            <h1 class="text-2xl font-bold text-[#7D6608]">
                BananaMart
            </h1>

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button class="bg-[#D4AC0D] px-4 py-2 rounded-lg font-semibold text-[#7D6608]">
                    Logout
                </button>
            </form>

        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-4 py-10">

        <div class="bg-[#FCF3CF] rounded-2xl p-8 shadow-lg border border-[#D4AC0D]">

            <h2 class="text-3xl font-bold text-[#7D6608]">
                Selamat Datang, {{ auth()->user()->name }}!
            </h2>

            <p class="mt-3 text-[#9A7D0A]">
                Temukan berbagai produk pisang terbaik di BananaMart.
            </p>

        </div>

    </main>

</body>
</html>