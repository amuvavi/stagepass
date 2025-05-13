<div>
    <div class="p-6">
        <h1 class="mb-4 text-xl font-bold">Seat Map: {{ $event->name }}</h1>

        <x-flash event="seat-updated" type="success" />
        <x-flash event="seat-error" type="error" />

        <div class="grid gap-1" style="grid-template-columns: repeat({{ $event->columns }}, 1fr);">
            @foreach ($seats as $seat)
                <div x-data>
                    <button
                        @click="if (confirm('Toggle availability for this seat?')) { $wire.toggleAvailability({{ $seat->id }}) }"
                        class="p-2 text-center border rounded text-xs w-full
                   {{ $seat->status === 'sold'
                       ? 'bg-red-500 text-white cursor-not-allowed'
                       : ($seat->status === 'unavailable'
                           ? 'bg-yellow-300'
                           : 'bg-green-300') }}"
                        {{ $seat->status === 'sold' ? 'disabled' : '' }}>
                        R{{ $seat->row_number }}-C{{ $seat->column_number }}
                        <br><small>{{ ucfirst($seat->status) }}</small>
                    </button>
                </div>
            @endforeach

        </div>
    </div>
</div>
