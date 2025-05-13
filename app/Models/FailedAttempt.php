<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class FailedAttempt extends Model
{
    use HasFactory;
    
    protected $fillable = ['user_id', 'event_id', 'seat_id', 'attempted_at', 'reason'];

       protected $casts = [
    'attempted_at' => 'datetime',
];


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

    public function seat(): BelongsTo
    {
        return $this->belongsTo(Seat::class);
    }
}
