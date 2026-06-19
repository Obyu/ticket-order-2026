<div class="container mx-auto max-w-3xl p-8">

    <div
        class="
            bg-white
            rounded-xl
            shadow-lg
            border
            p-8
        "
    >

        <h1
            class="
                text-3xl
                font-bold
                text-center
                mb-8
            "
        >
            🎟️ E-Ticket
        </h1>

        <div class="space-y-3">

            <div>
                <strong>Booking Code :</strong>
                {{ $booking->booking_code }}
            </div>

            <div>
                <strong>Movie :</strong>
                {{ $booking->schedule->movie->title }}
            </div>

            <div>
                <strong>Studio :</strong>
                {{ $booking->schedule->studio->name }}
            </div>

            <div>
                <strong>Status :</strong>

                <span
                    class="
                        px-3
                        py-1
                        rounded
                        text-white
                        bg-green-500
                    "
                >
                    {{ strtoupper($booking->status) }}
                </span>

            </div>

            <div>
                <strong>Seats :</strong>

                @foreach($booking->seats as $seat)

                    <span
                        class="
                            inline-block
                            px-2
                            py-1
                            bg-gray-200
                            rounded
                            mr-1
                        "
                    >
                        {{ $seat->code }}
                    </span>

                @endforeach

            </div>

            <div>
                <strong>Total :</strong>

                Rp {{ number_format(
                    $booking->total_price,
                    0,
                    ',',
                    '.'
                ) }}
            </div>

        </div>

        <div class="mt-10 flex justify-center">

            {!! QrCode::size(250)->generate(
                route(
                    'ticket.validate',
                    $booking->qr_token
                )
            ) !!}

        </div>
        <a
            href="{{ route(
                'ticket.pdf',
                $booking
            ) }}"
            class="
                inline-block
                mt-4
                bg-black
                text-white
                px-4
                py-2
                rounded
            "
        >
            Download PDF
        </a>

    </div>

</div>