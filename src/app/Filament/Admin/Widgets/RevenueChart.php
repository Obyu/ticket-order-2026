<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Booking;
use Filament\Widgets\ChartWidget;

class RevenueChart extends ChartWidget
{
    protected static ?string $heading = 'Revenue 7 Hari Terakhir';

    protected function getFilters(): ?array
    {
        return [
            '7' => '7 Hari',
            '30' => '30 Hari',
        ];
    }

    protected function getData(): array
    {
        $days = (int) $this->filter ?: 7;
        $data = collect(
            range($days - 1, 0)
        )->map(function ($day) {

           
            $date = now()->subDays($day);

            
            return Booking::query()
                ->where('status', 'paid')
                ->whereDate(
                    'updated_at',
                    $date
                )
                ->sum('total_price');
        });

        return [
            'datasets' => [
                [
                    'label' => 'Revenue',
                    'data' => $data,
                ],
            ],

            'labels' => collect(
                range(6, 0)
            )->map(fn ($day) =>
                now()
                    ->subDays($day)
                    ->format('d M')
            ),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}