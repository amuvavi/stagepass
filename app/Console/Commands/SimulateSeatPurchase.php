<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Seat;
use App\Jobs\AttemptSeatPurchase;

use App\Models\FailedAttempt;

use Carbon\Carbon;

use App\Services\SeatPurchaseSimulatorService;

class SimulateSeatPurchase extends Command
{
    protected $signature = 'simulate:seat-purchase {event_id} {seat_row} {seat_col} {users=100}';
    protected $description = 'Simulate multiple users attempting to purchase the same seat simultaneously.';

   public function handle(SeatPurchaseSimulatorService $simulator)
   {
       $eventId = $this->argument('event_id');
       $seatRow = $this->argument('seat_row');
       $seatCol = $this->argument('seat_col');
       $userCount = (int) $this->argument('users');

       $seat = Seat::where('event_id', $eventId)
                   ->where('row_number', $seatRow)
                   ->where('column_number', $seatCol)
                   ->first();

       if (!$seat) {
           $this->error("Seat not found.");
           return;
       }

       $this->info("Dispatching {$userCount} queued purchase attempts...");

       $simulator->simulate($eventId, $seat->id, 1, $userCount); // 1 = fixed user ID

       $this->info("All jobs dispatched. Run your queue worker to process them.");
   }
}
