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
                    bg-amber-500
                    text-black
                    px-8
                    py-6
                "
            >

                <div class="text-sm font-semibold">
                    E-TICKET
                </div>

                <div class="text-4xl font-bold mt-2">
                    🎟 {{ $booking->booking_code }}
                </div>

            </div>

            <div class="p-8">

                {{-- Movie --}}
                <div class="mb-8">

                    <h1
                        class="
                            text-3xl
                            font-bold
                            mb-2
                        "
                    >
                        {{ $booking->schedule->movie->title }}
                    </h1>

                    <p class="text-slate-400">
                        {{ $booking->schedule->studio->name }}
                    </p>

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

                        <div class="text-slate-400">
                            Jadwal
                        </div>

                        <div class="font-bold">
                            {{ \Carbon\Carbon::parse($booking->schedule->start_time)->format('d M Y H:i') }}
                        </div>

                    </div>

                    <div>

                        <div class="text-slate-400">
                            Status
                        </div>

                        <span
                            @class([
                                'px-3 py-1 rounded-lg font-bold',

                                'bg-green-500 text-black'
                                    => $booking->status === 'paid',

                                'bg-yellow-500 text-black'
                                    => $booking->status === 'pending',

                                'bg-red-500 text-white'
                                    => $booking->status === 'expired',
                            ])
                        >
                            {{ strtoupper($booking->status) }}
                        </span>
                        @if(
                            $booking->expired_at
                            &&
                            $booking->expired_at->isPast()
                        )

                            <div
                                class="
                                    mt-4
                                    bg-red-500
                                    text-white
                                    p-3
                                    rounded-lg
                                "
                            >
                                Tiket Expired
                            </div>

                        @endif
                    </div>

                </div>

                {{-- Seats --}}
                <div class="mb-10">

                    <div class="text-slate-400 mb-3">
                        Seats
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

                {{-- QR --}}
                <div class="text-center">

                    <h2
                        class="
                            text-2xl
                            font-bold
                            mb-6
                        "
                    >
                        Scan QR Saat Masuk Studio
                    </h2>

                    <div
                        class="
                            inline-block
                            bg-white
                            p-6
                            rounded-2xl
                        "
                    >

                        {!! QrCode::size(250)->generate(
                            route(
                                'ticket.validate',
                                $booking->qr_token
                            )
                        ) !!}

                    </div>

                </div>

                {{-- PDF --}}
                <a
                    href="{{ route('ticket.pdf', $booking) }}"
                    class="
                        block
                        text-center
                        mt-10
                        bg-amber-500
                        text-black
                        py-4
                        rounded-xl
                        font-bold
                    "
                >
                    📄 Download PDF Ticket
                </a>

            </div>

        </div>

    </div>

</div>