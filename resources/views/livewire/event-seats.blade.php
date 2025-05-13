<div>
    <div class="p-6">
        <h1 class="text-xl font-bold mb-4">{{ $event->name }} - Select a Seat</h1>

        <x-flash event="seat-purchased" type="success" />
        <x-flash event="seat-purchase-error" type="error" />

        <div wire:poll.visible.3000ms>
            <div class="grid gap-1" style="grid-template-columns: repeat({{ $event->columns }}, 1fr);">
                @foreach ($seats as $seat)
                    <button x-data
                        @click="
        if (confirm('Are you sure you want to purchase seat R{{ $seat->row_number }}-C{{ $seat->column_number }}?')) {
            $wire.purchase({{ $seat->id }});
        }
    "
                        class="p-2 border rounded text-sm w-full
           {{ $seat->status === 'sold' ? 'bg-red-400 cursor-not-allowed' : 'bg-green-400 hover:bg-green-500' }}"
                        {{ $seat->status === 'sold' ? 'disabled' : '' }}>
                        R{{ $seat->row_number }}-C{{ $seat->column_number }}
                    </button>
                @endforeach
            </div>
        </div>

    </div>
</div>
