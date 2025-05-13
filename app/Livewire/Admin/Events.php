<?php
namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Event;
use App\Models\Seat;
use Carbon\Carbon;
use Livewire\WithPagination;
use App\Http\Requests\StoreOrUpdateEventRequest;
use Illuminate\Support\Facades\Validator;

class Events extends Component
{
    use WithPagination;

    public $eventId;
    public $name;
    public $description;
    public $date;
    public $rows = 10;
    public $columns = 10;

    public function resetForm()
    {
        $this->reset(['eventId', 'name', 'description', 'date', 'rows', 'columns']);
    }

    public function save()
    { 
        $validated = $this->validateEvent();

        $isNew = !$this->eventId;

        $event = Event::updateOrCreate(['id' => $this->eventId], [
            ...$validated,
            'description' => $this->description,
            'date' => Carbon::parse($validated['date']),
        ]);

        if ($isNew) {
            $this->generateSeatsForEvent($event);
        }

        $this->dispatch('event-saved', message: $isNew ? 'Event created successfully!' : 'Event updated.');
        $this->resetForm();
    }

    private function validateEvent()
    {
        return Validator::make(
            $this->only(['name', 'date', 'rows', 'columns']),
            (new StoreOrUpdateEventRequest())->rules()
        )->validate();
    }

    private function generateSeatsForEvent(Event $event): void
    {
        $seats = [];

        for ($row = 1; $row <= $this->rows; $row++) {
            for ($col = 1; $col <= $this->columns; $col++) {
                $seats[] = [
                    'event_id' => $event->id,
                    'row_number' => $row,
                    'column_number' => $col,
                    'status' => 'available',
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        Seat::insert($seats);
    }

    public function edit($id)
    {
        $event = Event::findOrFail($id);

        $this->eventId = $event->id;
        $this->name = $event->name;
        $this->description = $event->description;
        $this->date = $event->date->format('Y-m-d\TH:i');
        $this->rows = $event->rows;
        $this->columns = $event->columns;
    }

    public function delete($id)
    {
        Event::findOrFail($id)->delete();

        $this->dispatch('event-deleted', message: 'Event deleted.');
    }

    public function render()
    {
        return view('livewire.admin.events', [
            'events' => Event::orderBy('date')->paginate(5),
        ]);
    }
}
