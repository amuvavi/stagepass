<div>
    @props([
        'event' => 'flash',
        'type' => 'success', // success | error | info
        'timeout' => 3000,
    ])

    @php
        $colorClasses = [
            'success' => 'bg-green-100 text-green-800',
            'error' => 'bg-red-100 text-red-800',
            'info' => 'bg-blue-100 text-blue-800',
        ];
    @endphp

    <div x-data="{ message: '', visible: false }" x-init="$wire.on('{{ $event }}', e => {
        message = e.message;
        visible = true;
        setTimeout(() => visible = false, {{ $timeout }});
    });" x-show="visible" x-transition
        class="mb-4 p-2 rounded {{ $colorClasses[$type] ?? $colorClasses['success'] }}" x-text="message">
    </div>

</div>
