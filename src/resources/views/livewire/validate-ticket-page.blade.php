<div class="container mx-auto max-w-3xl p-8">

    <div class="border rounded-xl p-8 bg-white">

        <h1 class="text-3xl font-bold mb-8">
            Ticket Validation
        </h1>

        <div class="mb-4">
            <strong>Booking :</strong>
            {{ $booking->booking_code }}
        </div>

        <div class="mb-4">
            <strong>Movie :</strong>
            {{ $booking->schedule->movie->title }}
        </div>

        <div class="mb-4">
            <strong>Seats :</strong>

            @foreach($booking->seats as $seat)

                {{ $seat->code }}

            @endforeach
        </div>

        <div class="mb-8">

            <strong>Status :</strong>

            @if($status === 'VALID')

                <span class="text-green-600 font-bold">
                    VALID
                </span>
                @if($status === 'VALID')

                    <button
                        wire:click="checkIn"
                        class="
                            mt-4
                            px-4
                            py-2
                            bg-green-600
                            text-white
                            rounded
                        "
                    >
                        Check In
                    </button>

                @endif

            @elseif($status === 'USED')

                <span class="text-orange-600 font-bold">
                    USED
                </span>

            @else

                <span class="text-red-600 font-bold">
                    INVALID
                </span>

            @endif

        </div>

    </div>

</div>