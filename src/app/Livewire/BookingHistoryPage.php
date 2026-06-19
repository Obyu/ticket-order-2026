<?php

namespace App\Livewire;

use App\Models\Booking;
use Livewire\Component;

class BookingHistoryPage extends Component
{
    public function render()
    {
        return view(
            'livewire.booking-history-page',
            [
                'bookings' => Booking::query()
                    ->with([
                        'schedule.movie',
                        'seats',
                    ])
                    ->latest()
                    ->get(),
            ]
        )->layout('components.layouts.app');
    }
}