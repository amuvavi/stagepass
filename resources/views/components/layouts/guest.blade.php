<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'StagePass') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles

    <!-- AOS Animation CSS -->
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">
</head>

<body class="min-h-screen flex flex-col bg-white text-gray-800">

    <!-- Header -->
    <header class="w-full shadow-sm bg-white border-b border-zinc-200">
        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
            <!-- Logo -->
            <a href="{{ route('home') }}" class="flex items-center space-x-3" data-aos="fade-right">
                <img src="{{ asset('images/stagepass.png') }}" alt="StagePass Logo" class="h-20 w-auto">
                <span class="font-extrabold text-xl text-indigo-700 tracking-wide">StagePass</span>
            </a>

            <!-- Auth Links -->
            <div class="space-x-4" data-aos="fade-left">
                @auth
                    <a href="{{ route('dashboard') }}" class="text-sm font-medium text-indigo-600 hover:underline">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" class="text-sm font-medium text-indigo-600 hover:underline">
                        Login
                    </a>
                    <a href="{{ route('register') }}" class="text-sm font-medium text-indigo-600 hover:underline">
                        Register
                    </a>
                @endauth
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow">
        <div class="max-w-6xl mx-auto px-4 py-10">
            {{ $slot }}
        </div>
    </main>

     <!-- Sticky Footer -->
    <footer class="w-full border-t bg-white text-sm text-center py-4 text-gray-500" data-aos="fade-in">
        &copy; {{ date('Y') }} StagePass. All rights reserved.
    </footer>


    @livewireScripts

    <!-- AOS JS -->
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 500,
            easing: 'ease-in-out',
            once: true,
        });
    </script>
</body>
</html>
