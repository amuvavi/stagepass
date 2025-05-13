<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen antialiased bg-white dark:bg-linear-to-b dark:from-neutral-950 dark:to-neutral-900">
        <div class="flex flex-col items-center justify-center gap-6 p-6 bg-background min-h-svh md:p-10">
            <div class="flex flex-col w-full max-w-sm gap-2">
                <a href="{{ route('home') }}" class="flex flex-col items-center gap-2 font-medium" wire:navigate>
                    <span class="flex items-center justify-center w-24 h-24 mb-1 rounded-md">
                       <img src="{{ asset('images/stagepass.png') }}" alt="StagePass Logo" class="w-auto fill-current size-full">
                    </span>
                    <span class="sr-only">{{ config('app.name', 'StagePass') }}</span>
                </a>
                <div class="flex flex-col gap-6">
                    {{ $slot }}
                </div>
            </div>
        </div>
        @fluxScripts
    </body>
</html>
