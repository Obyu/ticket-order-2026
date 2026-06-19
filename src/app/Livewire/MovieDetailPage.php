<?php

namespace App\Livewire;

use App\Models\Movie;
use Livewire\Component;

class MovieDetailPage extends Component
{
    public Movie $movie;

    public function mount(Movie $movie): void
    {
       $this->movie = $movie->load([
            'genres',
            'schedules.studio',
        ]);
    }

    public function render()
    {
        return view('livewire.movie-detail-page');
    }
}