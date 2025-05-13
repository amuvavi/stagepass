<?php

namespace App\Services;

use App\Jobs\AttemptSeatPurchase;

class SeatPurchaseSimulatorService
{
    public function simulate(int $eventId, int $seatId, int $userId, int $attempts = 100): void
    {
        for ($i = 1; $i <= $attempts; $i++) {
            AttemptSeatPurchase::dispatch($eventId, $seatId, $userId);
        }
    }
}