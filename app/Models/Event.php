<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description', 'date', 'rows', 'columns'];

    protected $casts = [
    'date' => 'datetime',
];


    public function seats(): HasMany
    {
        return $this->hasMany(Seat::class);
    }

    public function purchases(): HasMany
    {
        return $this->hasMany(Purchase::class);
    }
}
