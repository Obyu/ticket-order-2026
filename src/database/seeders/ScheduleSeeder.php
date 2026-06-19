<?php

namespace Database\Seeders;

use App\Models\Movie;
use App\Models\Schedule;
use App\Models\Studio;
use Illuminate\Database\Seeder;

class ScheduleSeeder extends Seeder
{
    public function run(): void
    {
        $movies = Movie::all();
        $studio = Studio::first();

        foreach ($movies as $movie) {

            Schedule::firstOrCreate(
                [
                    'movie_id' => $movie->id,
                    'studio_id' => $studio->id,
                    'start_time' => now()->addDay()->setHour(13),
                ],
                [
                    'end_time' => now()->addDay()->setHour(16),
                    'price' => 50000,
                ]
            );

            Schedule::firstOrCreate(
                [
                    'movie_id' => $movie->id,
                    'studio_id' => $studio->id,
                    'start_time' => now()->addDay()->setHour(19),
                ],
                [
                    'end_time' => now()->addDay()->setHour(22),
                    'price' => 50000,
                ]
            );
        }
    }
}