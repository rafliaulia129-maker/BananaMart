<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Produk Pisang - BananaMart</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#F9E79F]">

    <nav class="bg-[#F4D03F] border-b border-[#D4AC0D]">
        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">

            <a href="{{ route('dashboard') }}"
               class="text-2xl font-bold text-[#7D6608]">
                BananaMart
            </a>

            <div class="flex items-center gap-4">

                <span class="font-semibold text-[#7D6608]">
                    {{ auth()->user()->name }}
                </span>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button
                        class="bg-[#D4AC0D] px-4 py-2 rounded-lg font-semibold text-[#7D6608]">
                        Logout
                    </button>
                </form>

            </div>

        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-4 py-8">

        @if(session('success'))
            <div class="mb-6 bg-[#FCF3CF] border border-[#D4AC0D] text-[#7D6608] px-4 py-3 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="mb-6 bg-[#FCF3CF] border border-[#D4AC0D] text-[#7D6608] px-4 py-3 rounded-lg">
                <ul class="list-disc ml-5">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')

    </main>

</body>

</html>