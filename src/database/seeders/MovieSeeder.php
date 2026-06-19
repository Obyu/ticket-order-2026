<?php

namespace Database\Seeders;

use App\Models\Movie;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class MovieSeeder extends Seeder
{
    public function run(): void
    {
        $movies = [
            [
                'title' => 'Avengers Endgame',
                'duration' => 181,
                'rating' => '8.5',
            ],
            [
                'title' => 'The Batman',
                'duration' => 176,
                'rating' => '8.0',
            ],
            [
                'title' => 'Interstellar',
                'duration' => 169,
                'rating' => '8.7',
            ],
            [
                'title' => 'John Wick 4',
                'duration' => 169,
                'rating' => '8.2',
            ],
        ];

        foreach ($movies as $movie) {

            Movie::firstOrCreate(
                [
                    'slug' => Str::slug($movie['title']),
                ],
                [
                    'title' => $movie['title'],
                    'poster' => null,
                    'banner' => null,
                    'trailer_url' => 'https://youtube.com',
                    'duration' => $movie['duration'],
                    'rating' => $movie['rating'],
                    'is_showing' => true,
                    'synopsis' => 'Demo synopsis movie.',
                ]
            );
        }
    }
}