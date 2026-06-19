<?php

namespace App\Livewire;

use App\Models\Booking;
use Livewire\Component;

class TicketPage extends Component
{
    public Booking $booking;

    public function mount(Booking $booking): void
    {
        $this->booking = $booking->load([
            'schedule.movie',
            'seats',
        ]);
    }

    public function render()
    {
        return view(
            'livewire.ticket-page'
        )->layout(
            'components.layouts.app'
        );
    }
}