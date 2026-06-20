<div class="min-h-screen bg-slate-950 text-white">


<div class="max-w-4xl mx-auto px-6 py-16">

    <div
        class="
            bg-slate-900
            border
            border-slate-800
            rounded-3xl
            overflow-hidden
        "
    >

        <div
            class="
                bg-amber-500
                text-black
                px-8
                py-5
                font-bold
                text-2xl
            "
        >
            💳 Payment
        </div>

        <div class="p-8">

            <div class="mb-8">

                <h2
                    class="
                        text-3xl
                        font-bold
                        mb-2
                    "
                >
                    {{ $booking->schedule->movie->title }}
                </h2>

                <p class="text-slate-400">
                    {{ $booking->schedule->studio->name }}
                </p>

            </div>

            <div
                class="
                    grid
                    md:grid-cols-2
                    gap-6
                    mb-10
                "
            >

                <div>

                    <div class="text-slate-400 mb-2">
                        Booking Code
                    </div>

                    <div class="font-bold">
                        {{ $booking->booking_code }}
                    </div>

                </div>

                <div>

                    <div class="text-slate-400 mb-2">
                        Seats
                    </div>

                    <div class="font-bold">
                        {{ $booking->seats->pluck('code')->join(', ') }}
                    </div>

                </div>

                <div>

                    <div class="text-slate-400 mb-2">
                        Schedule
                    </div>

                    <div class="font-bold">
                        {{ \Carbon\Carbon::parse($booking->schedule->start_time)->format('d M Y H:i') }}
                    </div>

                </div>

                <div>

                    <div class="text-slate-400 mb-2">
                        Status
                    </div>

                    <div class="text-yellow-400 font-bold">
                        PENDING PAYMENT
                    </div>

                </div>

            </div>

            <div
                class="
                    border-t
                    border-slate-800
                    pt-8
                "
            >

                <div class="text-slate-400 mb-2">
                    Total Payment
                </div>

                <div
                    class="
                        text-5xl
                        font-bold
                        text-amber-500
                        mb-8
                    "
                >
                    Rp {{ number_format($booking->total_price,0,',','.') }}
                </div>

                <button
                    wire:click="pay"
                    class="
                        w-full
                        py-4
                        rounded-xl
                        bg-amber-500
                        text-black
                        font-bold
                        text-lg
                        hover:opacity-90
                    "
                >
                    Simulate Payment
                </button>

            </div>

        </div>

    </div>

</div>


</div>
