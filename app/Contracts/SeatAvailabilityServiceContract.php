<?php

namespace App\Contracts;

use App\Models\Seat;

interface SeatAvailabilityServiceContract
{
    public function toggle(Seat $seat): Seat;

    public function isTogglable(Seat $seat): bool;
}