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