<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Booking;
use App\Models\Seat;
use Illuminate\Support\Facades\DB;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class BookingStats extends BaseWidget
{
    protected function getStats(): array
    {
        $occupied = DB::table('booking_seats')
            ->count();

        $totalSeats = Seat::count();

        $rate = $totalSeats > 0
            ? round(
                ($occupied / $totalSeats) * 100,
                2
            )
            : 0;

        return [

            Stat::make(
                'Total Booking',
                Booking::count()
            ),

            Stat::make(
                'Checked In',
                Booking::whereNotNull(
                    'checked_in_at'
                )->count()
            ),

            Stat::make(
                'Active Ticket',
                Booking::where(
                    'status',
                    'paid'
                )
                ->whereNull(
                    'checked_in_at'
                )
                ->count()
            ),

            Stat::make(
                'Occupancy Rate',
                $rate . '%'
            ),

        ];
    }
}