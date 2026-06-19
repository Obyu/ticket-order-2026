<div class="container mx-auto max-w-5xl p-8">

    <h1 class="text-3xl font-bold mb-8">
        Riwayat Booking
    </h1>

    <div class="space-y-4">

        @forelse($bookings as $booking)

            <div
                class="border rounded-lg p-5 bg-white"
            >

                <div class="font-bold text-lg">
                    {{ $booking->booking_code }}
                </div>

                <div>
                    Film :
                    {{ $booking->schedule->movie->title }}
                </div>

                <div>
                    Status :
                    {{ strtoupper($booking->status) }}
                </div>

                <div>
                    Total :
                    Rp {{ number_format(
                        $booking->total_price,
                        0,
                        ',',
                        '.'
                    ) }}
                </div>

                <div class="mt-2">

                    Kursi :

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

            </div>

        @empty

            <div>
                Belum ada booking.
            </div>

        @endforelse

    </div>

</div>