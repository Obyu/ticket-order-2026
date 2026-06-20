<?php

namespace App\Livewire;

use App\Models\Movie;
use Livewire\Component;

class MovieListPage extends Component
{
    public string $search = '';

    public function render()
    {
        return view(
    'livewire.movie-list-page',
    [
        'featuredMovies' => Movie::query()
            ->where('is_showing', true)
            ->latest()
            ->take(5)
            ->get(),

        'movies' => Movie::query()
            ->when(
                $this->search,
                fn ($query) =>
                    $query->where(
                        'title',
                        'like',
                        "%{$this->search}%"
                    )
            )
            ->get(),
    ]
)->layout('components.layouts.app');
    }
}