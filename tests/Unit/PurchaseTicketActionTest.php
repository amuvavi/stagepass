<?php

namespace App\Actions;

use App\Models\Purchase;
use App\Models\Seat;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class PurchaseTicketAction
{
    public function execute($userId, $eventId, $seatId)
    {
        DB::beginTransaction();

        try {
            $seat = Seat::where('id', $seatId)
                        ->where('event_id', $eventId)
                        ->lockForUpdate()
                        ->first();

            if (!$seat || $seat->status === 'sold') {
                DB::rollBack();
                $this->logFailure('Seat already sold');

                throw \Illuminate\Validation\ValidationException::withMessages([
                    'seat' => 'Seat is already sold',
                ]);
            }

            $seat->status = 'sold';
            $seat->save();

            $purchase = Purchase::create([
                'user_id' => $userId,
                'event_id' => $eventId,
                'seat_id' => $seatId,
                'purchased_at' => now(),
            ]);

            DB::commit();

            return $purchase;
        } catch (\Exception $e) {
            DB::rollBack();
            $this->logFailure($e->getMessage());
            throw $e;
        }
    }

    protected function logFailure($message)
    {
        // Log the failure message
    }
}