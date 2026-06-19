<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Movie extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'poster',
        'banner',
        'trailer_url',
        'synopsis',
        'duration',
        'rating',
        'is_showing',
    ];

    public function genres(): BelongsToMany
    {
        return $this->belongsToMany(Genre::class, 'movie_genre');
    }

    public function schedules(): HasMany
    {
        return $this->hasMany(Schedule::class);
    }
    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
