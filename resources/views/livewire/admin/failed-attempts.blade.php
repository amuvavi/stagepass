<div>
    <div class="p-6">
        <h1 class="text-2xl font-bold mb-4">Failed Purchase Attempts</h1>

        <!-- Search & Controls -->
        <div class="mb-4 flex flex-wrap gap-4 items-end">
            <input
                type="text"
                wire:model.live="search"
                placeholder="Search by event name..."
                class="p-2 border rounded w-full md:w-1/2"
            />

            <select wire:model.live="perPage" class="p-2 border rounded">
                <option value="10">10 per page</option>
                <option value="20">20 per page</option>
                <option value="50">50 per page</option>
            </select>

            <button
                wire:click="clearFilters"
                class="px-4 py-2 border rounded bg-indigo-100 hover:bg-indigo-200 text-sm">
                Clear
            </button>
        </div>

        <!-- Data Table -->
        <table class="w-full border-collapse table-auto">
            <thead>
                <tr class="bg-gray-100 text-left text-sm">
                    <th class="p-2 border">User</th>
                    <th class="p-2 border">Event</th>
                    <th class="p-2 border">Seat</th>
                    <th class="p-2 border">Attempted At</th>
                    <th class="p-2 border">Reason</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($attempts as $attempt)
                    <tr class="hover:bg-gray-50">
                        <td class="p-2 border">
                            {{ $attempt->user?->name ?? 'Simulated User (ID: ' . $attempt->user_id . ')' }}
                        </td>
                        <td class="p-2 border">{{ $attempt->event->name ?? '-' }}</td>
                        <td class="p-2 border">
                            R{{ $attempt->seat->row_number ?? '?' }}-C{{ $attempt->seat->column_number ?? '?' }}
                        </td>
                        <td class="p-2 border">{{ $attempt->attempted_at->format('M d, Y H:i:s') }}</td>
                        <td class="p-2 border text-red-600">{{ $attempt->reason }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="p-4 text-center text-gray-500">No failed attempts found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $attempts->links() }}
        </div>
    </div>
</div>
