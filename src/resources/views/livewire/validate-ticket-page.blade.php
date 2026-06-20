<div class="min-h-screen bg-slate-950 text-white">

    <div class="max-w-3xl mx-auto px-6 py-16">

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
                    p-8
                    text-center
                    border-b
                    border-slate-800
                "
            >

                <h1
                    class="
                        text-4xl
                        font-bold
                        mb-3
                    "
                >
                    Ticket Validation
                </h1>

                @if($status === 'VALID')

                    <div
                        class="
                            inline-flex
                            items-center
                            gap-2
                            px-4
                            py-2
                            rounded-xl
                            bg-green-500/20
                            text-green-400
                            font-bold
                        "
                    >
                        ✅ VALID
                    </div>

                @elseif($status === 'USED')

                    <div
                        class="
                            inline-flex
                            items-center
                            gap-2
                            px-4
                            py-2
                            rounded-xl
                            bg-orange-500/20
                            text-orange-400
                            font-bold
                        "
                    >
                        ⚠ USED
                    </div>

                @else

                    <div
                        class="
                            inline-flex
                            items-center
                            gap-2
                            px-4
                            py-2
                            rounded-xl
                            bg-red-500/20
                            text-red-400
                            font-bold
                        "
                    >
                        ❌ INVALID
                    </div>

                @endif

            </div>

            <div class="p-8 space-y-6">

                <div>

                    <div class="text-slate-400 text-sm">
                        Booking Code
                    </div>

                    <div class="text-xl font-bold">
                        {{ $booking->booking_code }}
                    </div>

                </div>

                <div>

                    <div class="text-slate-400 text-sm">
                        Movie
                    </div>

                    <div class="text-xl font-semibold">
                        {{ $booking->schedule->movie->title }}
                    </div>

                </div>

                <div>

                    <div class="text-slate-400 text-sm">
                        Studio
                    </div>

                    <div class="font-semibold">
                        {{ $booking->schedule->studio->name }}
                    </div>

                </div>

                <div>

                    <div class="text-slate-400 text-sm">
                        Seats
                    </div>

                    <div class="flex flex-wrap gap-2 mt-2">

                        @foreach($booking->seats as $seat)

                            <span
                                class="
                                    px-3
                                    py-1
                                    rounded-lg
                                    bg-amber-500
                                    text-black
                                    font-bold
                                "
                            >
                                {{ $seat->code }}
                            </span>

                        @endforeach

                    </div>

                </div>

                @if($booking->checked_in_at)

                    <div
                        class="
                            p-4
                            rounded-xl
                            bg-orange-500/10
                            border
                            border-orange-500/30
                        "
                    >
                        Checked In :
                        {{ $booking->checked_in_at->format('d M Y H:i') }}
                    </div>

                @endif

                @if($status === 'VALID')

                    <button
                        wire:click="checkIn"
                        class="
                            w-full
                            py-4
                            rounded-xl
                            bg-green-500
                            text-black
                            font-bold
                            text-lg
                            hover:opacity-90
                        "
                    >
                        CHECK IN TICKET
                    </button>

                @endif

            </div>

        </div>

    </div>

</div>