<div class="container mx-auto max-w-3xl p-8">

    <div class="bg-green-100 border border-green-300 rounded-lg p-6">

        <h1 class="text-3xl font-bold text-green-700 mb-4">
            Booking Berhasil
        </h1>

        <p class="mb-6">
            Booking berhasil dibuat.
        </p>

        <div class="space-y-3">

            <div>
                <strong>Kode Booking:</strong>
                {{ $booking->booking_code }}
            </div>

            <div>
                <strong>Film:</strong>
                {{ $booking->schedule->movie->title }}
            </div>

            <div>
                <strong>Studio:</strong>
                {{ $booking->schedule->studio->name }}
            </div>

            <div>
                <strong>Jadwal:</strong>
                {{ $booking->schedule->start_time }}
            </div>

            <div>
                <strong>Status:</strong>
                {{ strtoupper($booking->status) }}
            </div>

            <div>
                <strong>Total Harga:</strong>
                Rp {{ number_format($booking->total_price, 0, ',', '.') }}
            </div>

            <div>
                <strong>Kursi:</strong>

                @foreach($booking->seats as $seat)
                    <span class="inline-block bg-gray-200 px-2 py-1 rounded mr-1">
                        {{ $seat->code }}
                    </span>
                @endforeach

            </div>

        </div>

        <a
            href="{{ route('payment.show',$booking) }}"
            class="inline-block mt-6 px-6 py-3 bg-black text-white rounded"
        >
            bayar sekarang
        </a>

    </div>

</div>