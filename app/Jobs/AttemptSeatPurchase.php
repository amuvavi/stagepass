<?php

namespace App\Jobs;

use App\Models\FailedAttempt;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Actions\PurchaseTicketAction;
use App\Services\Logging\FailureLoggerService;

class AttemptSeatPurchase implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $eventId;
    public $seatId;
    public $userId;

    public function __construct($eventId, $seatId, $userId)
    {
        $this->eventId = $eventId;
        $this->seatId = $seatId;
        $this->userId = $userId;
    }

   public function handle(PurchaseTicketAction $action, FailureLoggerService $logger)
    {
        $success = $action->execute($this->eventId, $this->seatId, $this->userId);

        if (! $success) {
            $logger->log([
                'user_id' => $this->userId,
                'event_id' => $this->eventId,
                'seat_id' => $this->seatId,
                'reason' => 'Seat already sold or unavailable',
            ]);
        }
    }
}