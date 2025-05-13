<?php
namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Event;
use App\Models\Seat;
use App\Actions\ToggleSeatAvailabilityAction;
use Illuminate\Validation\ValidationException;

class EventSeats extends Component
{
    public Event $event;

    public function mount(Event $event)
    {
        $this->event = $event->load('seats');
    }

    public function toggleAvailability($seatId)
    {
        try {
            app(ToggleSeatAvailabilityAction::class)->execute($seatId);

            $this->dispatch('seat-updated', message: 'Seat status updated.');
            $this->event->refresh();
        } catch (ValidationException | \Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            $this->dispatch('seat-error', message: $e->getMessage());
        }
    }

    public function render()
    {
        $seats = $this->event->seats->sortBy([
            ['row_number', 'asc'],
            ['column_number', 'asc']
        ]);

        return view('livewire.admin.event-seats', [
            'seats' => $seats
        ]);
    }
}
