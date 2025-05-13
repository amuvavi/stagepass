<div>
    <div class="p-6">
        <h1 class="mb-4 text-2xl font-bold">Manage Events</h1>

        <x-flash event="event-saved" type="success" />
        <x-flash event="event-deleted" type="error" />

        <form wire:submit.prevent="save" class="mb-6 space-y-4">
            <div>
                <input type="text" wire:model.defer="name" placeholder="Event Name"
                    class="w-full p-2 border rounded" />
                    @error('name') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
            </div>
            <div>
                <textarea wire:model.defer="description" placeholder="Description" class="w-full p-2 border rounded"></textarea>
            </div>
            <div>
                <input type="datetime-local" wire:model.defer="date" class="p-2 border rounded" />
                @error('date') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
            </div>
            <div class="flex gap-4">
                <input type="number" wire:model.defer="rows" placeholder="Rows" class="w-1/2 p-2 border rounded" />
                 @error('rows') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                <input type="number" wire:model.defer="columns" placeholder="Columns"
                    class="w-1/2 p-2 border rounded" />
                    @error('columns') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                   
            </div>
            <button type="submit" class="px-4 py-2 text-white bg-indigo-600 rounded-full">Save Event</button>
        </form>

        <table class="w-full border-collapse table-auto">
            <thead>
                <tr class="bg-gray-100">
                    <th class="p-2 border">Name</th>
                    <th class="p-2 border">Date</th>
                    <th class="p-2 border">Seats</th>
                    <th class="p-2 border">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($events as $event)
                    <tr class="hover:bg-gray-50">
                        <td class="p-2 border">{{ $event->name }}</td>
                        <td class="p-2 border">{{ $event->date->format('M d, Y h:i A') }}</td>
                        <td class="p-2 border">{{ $event->rows }} x {{ $event->columns }}</td>
                        <td class="p-2 border">
                            <button wire:click="edit({{ $event->id }})"
                                class="text-blue-600 hover:underline">Edit</button> |
                            <a href="{{ route('admin.event.seats', $event) }}" class="text-indigo-600 hover:underline">
                                View Seats
                            </a> |

                            <button x-data
                                @click="if (confirm('Are you sure you want to delete this event?')) { $wire.delete({{ $event->id }}) }"
                                class="ml-3 text-red-600 hover:underline">
                                Delete
                            </button>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $events->links() }}
    </div>
</div>
