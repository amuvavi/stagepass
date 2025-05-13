<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Event;
use App\Models\Purchase;
use App\Models\Seat;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Actions\PurchaseTicketAction;
use App\Services\Logging\FailureLoggerService;

class EventSeats extends Component
{ 
    
    public Event $event;
    public $message;


    public function mount(Event $event)
    {
        $this->event = $event;
    }

    public function purchase($seatId)
    {
        if (!auth()->check()) {
            return redirect()->route('register');
        }

        $action = app(PurchaseTicketAction::class);
        $logger = app(FailureLoggerService::class);

        $success = $action->execute($this->event->id, $seatId, auth()->id());

        if ($success) {
            $this->dispatch('seat-purchased', message: 'Seat purchased successfully!');
        } else {
            $logger->log([
                'user_id' => auth()->id(),
                'event_id' => $this->event->id,
                'seat_id' => $seatId,
                'reason' => 'Seat already sold or unavailable',
            ]);

            $this->dispatch('seat-purchase-error', message: 'Sorry, this seat has just been sold.');
        }

        $this->event->refresh();
    }

    public function render()
    {
        return view('livewire.event-seats', [
            'seats' => $this->event->seats()->orderBy('row_number')->orderBy('column_number')->get()
        ]);
    }

}
