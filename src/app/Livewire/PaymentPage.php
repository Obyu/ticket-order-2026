<?php

namespace App\Livewire;

use App\Models\Booking;
use Livewire\Component;
use Illuminate\Support\Str;

class PaymentPage extends Component
{
    public Booking $booking;

    public function mount(
        Booking $booking
    ): void
    {
        $this->booking = $booking->load([
            'schedule.movie',
            'seats',
        ]);
    }

    public function pay()
    {
        $this->booking->update([
            'status' => 'paid',
            'qr_token' => (string) Str::uuid(),
        ]);

        session()->flash(
            'success',
            'Pembayaran berhasil'
        );

        return redirect()->route(
            'ticket.show',
            $this->booking
        );
    }

    public function render()
    {
        return view(
            'livewire.payment-page'
        )->layout(
            'components.layouts.app'
        );
    }
}