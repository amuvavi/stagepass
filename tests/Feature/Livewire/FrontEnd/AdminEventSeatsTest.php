<?php

namespace Tests\Feature\Livewire\Admin;

use App\Livewire\Admin\EventSeats;
use App\Models\Event;
use App\Models\Seat;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class AdminEventSeatsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_renders_event_seats()
    {
        $event = Event::factory()->create();
        Seat::factory()->create(['event_id' => $event->id, 'row_number' => 1, 'column_number' => 1]);

        Livewire::actingAs(User::factory()->create(['role' => 'admin']))
            ->test(EventSeats::class, ['event' => $event])
            ->assertSee('R1-C1');
    }

    /** @test */
    public function it_toggles_available_to_unavailable()
    {
        $event = Event::factory()->create();
        $seat = Seat::factory()->create(['event_id' => $event->id, 'status' => 'available']);

        Livewire::actingAs(User::factory()->create(['role' => 'admin']))
            ->test(EventSeats::class, ['event' => $event])
            ->call('toggleAvailability', $seat->id);

        $this->assertEquals('unavailable', $seat->fresh()->status);
    }

    /** @test */
    public function it_blocks_toggle_for_sold_seat()
    {
        $event = Event::factory()->create();
        $seat = Seat::factory()->create(['event_id' => $event->id, 'status' => 'sold']);

        Livewire::actingAs(User::factory()->create(['role' => 'admin']))
            ->test(EventSeats::class, ['event' => $event])
            ->call('toggleAvailability', $seat->id)
            ->assertDispatched('seat-error');
    }
}
