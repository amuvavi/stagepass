<?php

namespace App\Contracts;

interface TicketPurchaseServiceContract
{
    public function purchase(int $eventId, int $seatId, int $userId): bool;
}