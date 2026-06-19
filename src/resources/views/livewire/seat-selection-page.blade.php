


    <div class="container mx-auto p-8">

        <h1 class="text-3xl font-bold mb-8">
            Pilih Kursi
        </h1>

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
                    max-w-3xl
                    mx-auto
                    bg-gray-300
                    text-center
                    py-3
                    rounded
                    font-bold
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

        {{-- Error --}}
        @error('seat')

            <div
                class="
                    mt-4
                    text-red-600
                    font-semibold
                "
            >
                {{ $message }}
            </div>

        @enderror

        {{-- Summary --}}
        <div
            class="
                mt-10
                border
                rounded-lg
                p-6
                bg-gray-50
            "
        >

            <h2 class="text-xl font-bold mb-4">
                Ringkasan Booking
            </h2>

            
            <div class="mb-2">

                Total Seat :

                <strong>
                    {{ count($selectedSeats) }}
                </strong>

            </div>

            <div class="mb-4">

                Total Harga :

                <strong>
                    Rp
                    {{ number_format(
                        count($selectedSeats)
                        * $schedule->price,
                        0,
                        ',',
                        '.'
                    ) }}
                </strong>

            </div>

            @if(count($selectedSeats))

                <button
                    wire:click="checkout"
                    class="
                        bg-black
                        text-white
                        px-6
                        py-3
                        rounded
                    "
                >
                    Checkout
                </button>

            @endif

        </div>

    </div>
