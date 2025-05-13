@auth
    <x-layouts.app.sidebar :title="$title ?? null">
        <flux:main>
            {{ $slot }}
        </flux:main>
    </x-layouts.app.sidebar>
@else
    <x-layouts.guest>
        {{ $slot }}
    </x-layouts.guest>
@endauth
