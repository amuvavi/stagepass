<div class="space-y-8">
    <h1 class="text-3xl font-bold text-gray-800" data-aos="fade-down">🎟️ Upcoming Events</h1>

    <div class="space-y-5">
        @foreach ($events as $event)
            <div
                class="bg-indigo-50 border border-indigo-100 rounded-lg p-5 shadow-sm hover:shadow-md transition"
                data-aos="fade-up"
                data-aos-delay="{{ $loop->index * 100 }}"
            >
                <div class="flex justify-between items-center">
                    <div>
                        <h2 class="text-xl font-semibold text-indigo-800">{{ $event->name }}</h2>
                        <p class="text-sm text-gray-500 mt-1">{{ $event->date->format('M d, Y h:i A') }}</p>
                    </div>
                    <a href="{{ route('events.seats', $event) }}"
                       class="inline-block px-4 py-2 rounded-full bg-indigo-600 text-white text-sm font-medium hover:bg-indigo-700 transition">
                        View Seats
                    </a>
                </div>
            </div>
        @endforeach
    </div>
</div>
