<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Booking extends Model
{
        protected $casts = [
            'expired_at' => 'datetime',
            'checked_in_at' => 'datetime',
        ];
        protected $signature = 'booking:expire';
    protected $fillable = [
        'user_id',
        'schedule_id',
        'booking_code',
        'total_price',
        'status',
        'qr_token',
        'checked_in_at',
        'expired_at',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function schedule(): BelongsTo
    {
        return $this->belongsTo(Schedule::class);
    }

    public function seats(): BelongsToMany
    {
        return $this->belongsToMany(
            Seat::class,
            'booking_seats'
        )->withPivot('price');
    }

}