<?php

namespace App\Services;

use App\Models\Seat;
use App\Contracts\SeatAvailabilityServiceContract;
use Illuminate\Validation\ValidationException;

class SeatAvailabilityService implements SeatAvailabilityServiceContract
{
    public function toggle(Seat $seat): Seat
    {
        if (! $this->isTogglable($seat)) {
            throw ValidationException::withMessages([
                'seat' => 'Cannot update a sold seat.',
            ]);
        }

        $seat->status = $seat->status === 'available' ? 'unavailable' : 'available';
        $seat->save();

        return $seat;
    }

    public function isTogglable(Seat $seat): bool
    {
        return $seat->status !== 'sold';
    }
}
