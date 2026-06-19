<?php

namespace App\Livewire;

use App\Models\Booking;
use Livewire\Component;

class BookingSuccessPage extends Component
{
    public Booking $booking;

    public function mount(Booking $booking): void
    {
        $this->booking = $booking->load([
            'schedule.movie',
            'schedule.studio',
            'seats',
        ]);
    }

    public function render()
    {
        return view(
            'livewire.booking-success-page'
        )->layout('components.layouts.app');
    }
}