<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Booking;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class RevenueStats extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [

            Stat::make(
                'Revenue',
                'Rp ' . number_format(
                    Booking::where('status', 'paid')
                        ->sum('total_price')
                )
            ),

        ];
    }
}