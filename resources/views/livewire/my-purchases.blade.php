<div>
    <div class="flex flex-wrap gap-4 mb-4">
        <input
            type="text"
            placeholder="Search event..."
            wire:model.live="search"
            class="w-full p-2 border rounded md:w-1/3"
        >

        <input
            type="date"
            wire:model.live="dateFrom"
            class="p-2 border rounded"
        >

        <input
            type="date"
            wire:model.live="dateTo"
            class="p-2 border rounded"
        >

        <select wire:model.live="perPage" class="p-2 border rounded">
            <option value="5">5</option>
            <option value="10">10</option>
            <option value="25">25</option>
        </select>

        <button wire:click="clearFilters"
            class="px-4 py-2 text-sm text-indigo-700 bg-indigo-100 border border-indigo-300 rounded-full hover:bg-indigo-300">
            Clear
        </button>
    </div>

    <table class="w-full border-collapse table-auto">
        <thead>
            <tr class="text-sm text-left bg-gray-100">
                <th class="p-2 border">Event</th>
                <th class="p-2 border">Seat</th>
                <th class="p-2 border">Purchased At</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($purchases as $purchase)
                <tr>
                    <td class="p-2 border">{{ $purchase->event->name ?? '—' }}</td>
                    <td class="p-2 border">
                        R{{ $purchase->seat->row_number ?? '?' }}-C{{ $purchase->seat->column_number ?? '?' }}
                    </td>
                    <td class="p-2 border">
                        {{ $purchase->purchased_at?->format('M d, Y h:i A') }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="p-4 text-center text-gray-500">No purchases found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-4">
        {{ $purchases->links() }}
    </div>
</div>