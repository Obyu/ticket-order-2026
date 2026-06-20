<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket Order</title>

    @vite(['resources/css/app.css'])
    @livewireStyles
</head>
<body class="bg-slate-950 text-white min-h-screen">
<nav
    class="
        sticky
        top-0
        z-50
        bg-slate-950/90
        backdrop-blur
        border-b
        border-slate-800
    "
>
    <div
        class="
            max-w-7xl
            mx-auto
            px-6
            py-4
            flex
            justify-between
            items-center
        "
    >

        <a
            href="{{ route('home') }}"
            class="
                text-2xl
                font-bold
                text-amber-500
            "
        >
            🎬 Ticket Order
        </a>

        <div class="flex gap-6">

            <a
                href="{{ route('home') }}"
                class="hover:text-amber-500"
            >
                Home
            </a>

            <a
                href="{{ route('home') }}#movies"
                class="hover:text-amber-500"
            >
                Movies
            </a>

        </div>

    </div>
</nav>

    {{ $slot }}
<footer
    class="
        mt-24
        border-t
        border-slate-800
        bg-slate-950
    "
>

    <div
        class="
            max-w-7xl
            mx-auto
            px-6
            py-10
            text-center
        "
    >

        <div
            class="
                text-2xl
                font-bold
                text-amber-500
                mb-3
            "
        >
            🎬 Ticket Order
        </div>

        <p class="text-slate-400">
            Online Movie Ticket Booking System
        </p>

        <div
            class="
                mt-6
                text-sm
                text-slate-500
            "
        >
            Laravel • Livewire • Filament • MariaDB
        </div>

        <div
            class="
                mt-2
                text-sm
                text-slate-600
            "
        >
            © {{ now()->year }} Ticket Order
        </div>

    </div>

</footer>
    @livewireScripts
</body>
</html>