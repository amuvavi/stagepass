<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Purchase extends Model
{
   use HasFactory;
   protected $fillable = ['user_id', 'event_id', 'seat_id', 'purchased_at'];

   protected $casts = [
    'purchased_at' => 'datetime',
];

  public function user()
{
    return $this->belongsTo(User::class);
}

public function event()
{
    return $this->belongsTo(Event::class);
}

public function seat()
{
    return $this->belongsTo(Seat::class);
}

}
