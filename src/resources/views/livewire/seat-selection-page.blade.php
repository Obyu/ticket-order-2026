<div class="min-h-screen bg-slate-950 text-white">

```
<div class="max-w-7xl mx-auto px-6 py-12">

    <div class="mb-10">

        <h1 class="text-4xl font-bold mb-2">
            {{ $schedule->movie->title }}
        </h1>

        <p class="text-slate-400">
            {{ $schedule->studio->name }}
            •
            {{ \Carbon\Carbon::parse($schedule->start_time)->format('d M Y H:i') }}
        </p>

    </div>

    <div class="grid lg:grid-cols-3 gap-8">

        {{-- Seat Area --}}
        <div class="lg:col-span-2">

            <h2 class="text-3xl font-bold mb-8">
                Pilih Kursi
            </h2>

            {{-- Legend --}}
            <div class="flex gap-6 mb-8">

                <div class="flex items-center gap-2">
                    <div class="w-5 h-5 rounded bg-green-500"></div>
                    <span>Tersedia</span>
                </div>

                <div class="flex items-center gap-2">
                    <div class="w-5 h-5 rounded bg-blue-500"></div>
                    <span>Dipilih</span>
                </div>

                <div class="flex items-center gap-2">
                    <div class="w-5 h-5 rounded bg-red-500"></div>
                    <span>Terisi</span>
                </div>

            </div>

            {{-- Screen --}}
            <div class="mb-10">

                <div
                    class="
                        w-full
                        max-w-4xl
                        mx-auto
                        bg-gradient-to-r
                        from-slate-700
                        via-white
                        to-slate-700
                        text-black
                        text-center
                        py-4
                        rounded-full
                        font-bold
                        shadow-lg
                    "
                >
                    SCREEN
                </div>

            </div>

            {{-- Seats --}}
            <div class="grid grid-cols-10 gap-2">

                @foreach(
                    $schedule->studio->seats
                        ->sortBy('code')
                    as $seat
                )

                    <button
                        wire:click="toggleSeat({{ $seat->id }})"

                        @disabled(
                            in_array(
                                $seat->id,
                                $bookedSeats
                            )
                        )

                        @class([

                            'p-2',
                            'rounded',
                            'border',
                            'text-center',
                            'font-semibold',
                            'transition',

                            'bg-red-500 text-white cursor-not-allowed'
                                => in_array(
                                    $seat->id,
                                    $bookedSeats
                                ),

                            'bg-blue-500 text-white'
                                => in_array(
                                    $seat->id,
                                    $selectedSeats
                                ),

                            'bg-green-500 text-white hover:scale-105'
                                => ! in_array(
                                    $seat->id,
                                    $bookedSeats
                                )
                                && ! in_array(
                                    $seat->id,
                                    $selectedSeats
                                ),
                        ])
                    >

                        {{ $seat->code }}

                    </button>

                @endforeach

            </div>

        </div>

        {{-- Summary --}}
        <div>

            <div
                class="
                    sticky
                    top-6
                    bg-slate-900
                    border
                    border-slate-800
                    rounded-2xl
                    p-6
                "
            >

                <h2 class="text-2xl font-bold mb-6">
                    Ringkasan Booking
                </h2>

                <div class="mb-4">

                    <div class="text-slate-400 mb-2">
                        Seat Dipilih
                    </div>

                    <div class="font-bold">

                        {{
                            $schedule
                                ->studio
                                ->seats
                                ->whereIn(
                                    'id',
                                    $selectedSeats
                                )
                                ->pluck('code')
                                ->join(', ')
                        }}

                    </div>

                </div>

                <div class="mb-4">

                    <div class="text-slate-400">
                        Jumlah Kursi
                    </div>

                    <div class="text-2xl font-bold">
                        {{ count($selectedSeats) }}
                    </div>

                </div>

                <div class="mb-8">

                    <div class="text-slate-400">
                        Total Harga
                    </div>

                    <div
                        class="
                            text-3xl
                            font-bold
                            text-amber-500
                        "
                    >
                        Rp
                        {{ number_format(
                            count($selectedSeats)
                            * $schedule->price,
                            0,
                            ',',
                            '.'
                        ) }}
                    </div>

                </div>

                @if(count($selectedSeats))

                    <button
                        wire:click="checkout"
                        class="
                            w-full
                            bg-amber-500
                            text-black
                            py-4
                            rounded-xl
                            font-bold
                            hover:opacity-90
                        "
                    >
                        Checkout
                    </button>

                @endif

            </div>

        </div>

    </div>

</div>
```

</div>
