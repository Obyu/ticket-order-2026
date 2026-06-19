<div class="container mx-auto max-w-3xl p-8">

    <h1 class="text-3xl font-bold mb-8">
        Payment Simulation
    </h1>

    @if(session('success'))

        <div
            class="bg-green-100 border border-green-300 p-4 rounded mb-6"
        >
            {{ session('success') }}
        </div>

    @endif

    <div
        class="border rounded-lg p-6 bg-white"
    >

        <div class="mb-3">

            <strong>Booking Code:</strong>

            {{ $booking->booking_code }}

        </div>

        <div class="mb-3">

            <strong>Film:</strong>

            {{ $booking->schedule->movie->title }}

        </div>

        <div class="mb-3">

            <strong>Status:</strong>

            <span
                class="
                    px-2 py-1 rounded
                    {{ $booking->status === 'paid'
                        ? 'bg-green-500 text-white'
                        : 'bg-yellow-500 text-white'
                    }}
                "
            >
                {{ strtoupper($booking->status) }}
            </span>

        </div>

        <div class="mb-3">

            <strong>Total:</strong>

            Rp
            {{ number_format(
                $booking->total_price,
                0,
                ',',
                '.'
            ) }}

        </div>

        <div class="mb-6">

            <strong>Kursi:</strong>

            @foreach($booking->seats as $seat)

                <span
                    class="
                        inline-block
                        bg-gray-200
                        px-2
                        py-1
                        rounded
                        mr-1
                    "
                >
                    {{ $seat->code }}
                </span>

            @endforeach

        </div>

        @if($booking->status !== 'paid')

            <button
                wire:click="pay"
                class="
                    bg-black
                    text-white
                    px-6
                    py-3
                    rounded
                "
            >
                Bayar Sekarang
            </button>

        @endif

    </div>

</div>