<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Ticket</title>
</head>
<body>

    <h1>E-Ticket</h1>

    <hr>

    <p>
        Booking :
        {{ $booking->booking_code }}
    </p>

    <p>
        Movie :
        {{ $booking->schedule->movie->title }}
    </p>

    <p>
        Studio :
        {{ $booking->schedule->studio->name }}
    </p>

    <p>
        Status :
        {{ strtoupper($booking->status) }}
    </p>

    <p>
        Seats :

        @foreach($booking->seats as $seat)
            {{ $seat->code }}
        @endforeach
    </p>

    <p>
        Total :
        Rp {{ number_format(
            $booking->total_price,
            0,
            ',',
            '.'
        ) }}
    </p>

</body>
</html>