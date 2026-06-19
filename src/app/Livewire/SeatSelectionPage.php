<?php

namespace App\Livewire;

use App\Models\Booking;
use App\Models\Schedule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Livewire\Component;

class SeatSelectionPage extends Component
{
    public Schedule $schedule;

    public array $selectedSeats = [];

    public array $bookedSeats = [];

    public function mount(Schedule $schedule): void
    {
        $this->schedule = $schedule->load(
            'studio.seats'
        );

        $this->loadBookedSeats();
    }

    protected function loadBookedSeats(): void
    {
        $this->bookedSeats = $this->schedule
            ->bookings()
            ->where(function ($query) {

                $query
                    ->where('status', 'paid')

                    ->orWhere(function ($query) {

                        $query
                            ->where('status', 'pending')
                            ->where('expired_at', '>', now());
                    });
            })
            ->with('seats')
            ->get()
            ->pluck('seats')
            ->flatten()
            ->pluck('id')
            ->unique()
            ->toArray();
    }

    public function toggleSeat(int $seatId): void
    {
        $this->selectedSeats[] = $seatId;
    }

    public function checkout(): void
    {
        if (empty($this->selectedSeats)) {
            return;
        }

        $booking = DB::transaction(function () {

            $latestBookedSeats = $this->schedule
                ->bookings()
                ->where(function ($query) {

                    $query
                        ->where('status', 'paid')

                        ->orWhere(function ($query) {

                            $query
                                ->where('status', 'pending')
                                ->where('expired_at', '>', now());
                        });
                })
                ->with('seats')
                ->get()
                ->pluck('seats')
                ->flatten()
                ->pluck('id')
                ->toArray();

            foreach ($this->selectedSeats as $seatId) {

                if (in_array($seatId, $latestBookedSeats)) {

                    throw new \Exception(
                        'Seat sudah dibooking.'
                    );
                }
            }

            $booking = Booking::create([
                'user_id' => 1,
                'schedule_id' => $this->schedule->id,
                'booking_code' => 'BK-' . strtoupper(Str::random(8)),
                'total_price' => count($this->selectedSeats)
                    * $this->schedule->price,
                'status' => 'pending',
                'expired_at' => now()->addMinutes(10),
            ]);

            foreach ($this->selectedSeats as $seatId) {

                $booking->seats()->attach(
                    $seatId,
                    [
                        'price' => $this->schedule->price,
                    ]
                );
            }

            return $booking;
        });

        redirect()->route(
            'booking.success',
            $booking
        );
    }

    public function render()
    {
        return view(
            'livewire.seat-selection-page'
        )->layout('components.layouts.app');
    }
}