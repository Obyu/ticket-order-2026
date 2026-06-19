<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Barryvdh\DomPDF\Facade\Pdf;

class TicketPdfController extends Controller
{
    public function download(
        Booking $booking
    )
    {
        $booking->load([
            'schedule.movie',
            'schedule.studio',
            'seats',
        ]);

        $pdf = Pdf::loadView(
            'pdf.ticket',
            compact('booking')
        );

        return $pdf->download(
            $booking->booking_code . '.pdf'
        );
    }
}