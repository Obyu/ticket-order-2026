<?php

namespace Database\Seeders;

use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class MovieSeeder extends Seeder
{
    public function run(): void
    {
        $movies = [

            'Avengers Endgame',
            'Interstellar',
            'John Wick 4',
            'Top Gun Maverick',
            'Oppenheimer',
            'Joker',
            'The Batman',
            'Fast X',
            'Mission Impossible',
            'Doctor Strange',

        ];

        foreach ($movies as $index => $title) {

            $movie = Movie::create([

                'title' => $title,

                'slug' => Str::slug($title),

                'poster' =>
                    "https://picsum.photos/400/600?random="
                    . ($index + 1),

                'banner' =>
                    "https://picsum.photos/1200/500?random="
                    . ($index + 100),

                'trailer_url' =>
                    'https://www.youtube.com/watch?v=dQw4w9WgXcQ',

                'synopsis' =>
                    'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum in libero vel purus malesuada viverra.',

                'duration' =>
                    rand(90, 180),

                'rating' =>
                    rand(70, 95) / 10,

                'is_showing' =>
                    true,
            ]);

            $genreIds = Genre::query()
                ->inRandomOrder()
                ->limit(rand(1, 3))
                ->pluck('id');

            $movie->genres()->attach(
                $genreIds
            );
        }
    }
}