<?php 

namespace App\Actions;

use App\Models\Seat;
use App\Contracts\SeatAvailabilityServiceContract;

class ToggleSeatAvailabilityAction
{
    public function __construct(protected SeatAvailabilityServiceContract $service) {}

    public function execute(int $seatId): Seat
    {
        $seat = Seat::findOrFail($seatId);
        return $this->service->toggle($seat);
    }
}