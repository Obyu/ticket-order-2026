<?php

namespace App\Livewire;

use App\Models\Booking;
use Livewire\Component;

class ValidateTicketPage extends Component
{
    public Booking $booking;

    public string $status;

    public function mount(string $token): void
    {
        $this->booking = Booking::query()
            ->where('qr_token', $token)
            ->with([
                'schedule.movie',
                'seats',
            ])
            ->firstOrFail();

        if ($this->booking->status !== 'paid') {

            $this->status = 'INVALID';

            return;
        }

        if ($this->booking->checked_in_at) {

            $this->status = 'USED';

            return;
        }

        $this->status = 'VALID';
    }

public function checkIn(): void
{
    $this->booking->update([
        'checked_in_at' => now(),
    ]);

    dd(
        $this->booking->fresh()
    );
}

    public function render()
    {
        return view(
            'livewire.validate-ticket-page'
        )->layout(
            'components.layouts.app'
        );
    }
}