<?php

namespace App\Actions;

use App\Contracts\TicketPurchaseServiceContract;

class PurchaseTicketAction
{
    public function __construct(protected TicketPurchaseServiceContract $service) {}

    public function execute(int $eventId, int $seatId, int $userId): bool
    {
        return $this->service->purchase($eventId, $seatId, $userId);
    }
}