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

            {{-- Header --}}
            <div
                class="
                    bg-green-500
                    text-black
                    px-8
                    py-6
                "
            >

                <div class="text-sm font-semibold">
                    BOOKING CREATED
                </div>

                <h1 class="text-4xl font-bold mt-2">
                    ✅ Booking Berhasil
                </h1>

            </div>

            <div class="p-8">

                {{-- Booking Code --}}
                <div
                    class="
                        bg-slate-800
                        rounded-2xl
                        p-6
                        mb-8
                    "
                >

                    <div class="text-slate-400 text-sm">
                        BOOKING CODE
                    </div>

                    <div
                        class="
                            text-3xl
                            font-bold
                            mt-2
                            text-amber-500
                        "
                    >
                        {{ $booking->booking_code }}
                    </div>

                </div>

                {{-- Detail --}}
                <div
                    class="
                        grid
                        md:grid-cols-2
                        gap-6
                        mb-8
                    "
                >

                    <div>

                        <div class="text-slate-400 mb-2">
                            Film
                        </div>

                        <div class="font-bold text-xl">
                            {{ $booking->schedule->movie->title }}
                        </div>

                    </div>

                    <div>

                        <div class="text-slate-400 mb-2">
                            Studio
                        </div>

                        <div class="font-bold">
                            {{ $booking->schedule->studio->name }}
                        </div>

                    </div>

                    <div>

                        <div class="text-slate-400 mb-2">
                            Jadwal
                        </div>

                        <div class="font-bold">
                            {{ \Carbon\Carbon::parse($booking->schedule->start_time)->format('d M Y H:i') }}
                        </div>

                    </div>

                    <div>

                        <div class="text-slate-400 mb-2">
                            Status
                        </div>

                        <span
                            class="
                                px-3
                                py-1
                                rounded-lg
                                bg-yellow-500
                                text-black
                                font-bold
                            "
                        >
                            {{ strtoupper($booking->status) }}
                        </span>

                    </div>

                </div>

                {{-- Seats --}}
                <div class="mb-8">

                    <div class="text-slate-400 mb-3">
                        Kursi
                    </div>

                    @foreach($booking->seats as $seat)

                        <span
                            class="
                                inline-block
                                bg-amber-500
                                text-black
                                font-bold
                                px-4
                                py-2
                                rounded-lg
                                mr-2
                                mb-2
                            "
                        >
                            {{ $seat->code }}
                        </span>

                    @endforeach

                </div>

                {{-- Total --}}
                <div
                    class="
                        border-t
                        border-slate-800
                        pt-6
                        mb-8
                    "
                >

                    <div class="text-slate-400">
                        Total Pembayaran
                    </div>

                    <div
                        class="
                            text-4xl
                            font-bold
                            text-amber-500
                            mt-2
                        "
                    >
                        Rp {{ number_format($booking->total_price, 0, ',', '.') }}
                    </div>

                </div>

                {{-- Action --}}
                <a
                    href="{{ route('payment.show', $booking) }}"
                    class="
                        block
                        w-full
                        text-center
                        bg-amber-500
                        text-black
                        py-4
                        rounded-xl
                        font-bold
                        text-lg
                    "
                >
                    💳 Bayar Sekarang
                </a>

            </div>

        </div>

    </div>

</div>