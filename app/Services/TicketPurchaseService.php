<?php

namespace App\Services;

use App\Models\Seat;
use App\Models\Purchase;
use Illuminate\Support\Facades\DB;
use App\Contracts\TicketPurchaseServiceContract;

class TicketPurchaseService implements TicketPurchaseServiceContract
{
    public function purchase(int $eventId, int $seatId, int $userId): bool
    {
        return DB::transaction(function () use ($eventId, $seatId, $userId) {
            $seat = Seat::where('id', $seatId)->lockForUpdate()->first();

            if (!$seat || $seat->status === 'sold') {
                return false;
            }

            Purchase::create([
                'user_id' => $userId,
                'event_id' => $eventId,
                'seat_id' => $seatId,
                'purchased_at' => now(),
            ]);

            $seat->update(['status' => 'sold']);
            return true;
        });
    }
}