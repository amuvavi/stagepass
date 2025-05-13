<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Seat extends Model
{
    use HasFactory;
   protected $fillable = ['event_id', 'row_number', 'column_number', 'status'];

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

    public function purchase(): HasOne
    {
        return $this->hasOne(Purchase::class);
    }

    public function isAvailable(): bool
    {
        return $this->status === 'available';
    }

}
