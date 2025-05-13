<?php

namespace Tests\Feature\Livewire\FrontEnd;

use App\Livewire\EventSeats;
use App\Models\Event;
use App\Models\Seat;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;
use Mockery;
use App\Actions\PurchaseTicketAction; // Add the correct namespace for PurchaseTicketAction

class EventSeatsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_renders_seats_for_event()
    {
        $event = Event::factory()->create(['rows' => 2, 'columns' => 2]);
        Seat::factory()->create(['event_id' => $event->id, 'row_number' => 1, 'column_number' => 1]);
        Seat::factory()->create(['event_id' => $event->id, 'row_number' => 2, 'column_number' => 2]);

        Livewire::test(EventSeats::class, ['event' => $event])
            ->assertSee('R1-C1')
            ->assertSee('R2-C2');
    }

    /** @test */
    public function it_disables_button_for_sold_seats()
    {
        $event = Event::factory()->create();
        Seat::factory()->create(['event_id' => $event->id, 'row_number' => 1, 'column_number' => 1, 'status' => 'sold']);

        Livewire::test(EventSeats::class, ['event' => $event])
            ->assertSee('cursor-not-allowed')
            ->assertSee('R1-C1');
    }

  
public function it_dispatches_success_flash_on_successful_purchase()
{
    $user = User::factory()->create();
    $event = Event::factory()->create(['rows' => 1, 'columns' => 1]);
    $seat = Seat::factory()->create([
        'event_id' => $event->id,
        'row_number' => 1,
        'column_number' => 1,
        'status' => 'available',
    ]);

    Livewire::actingAs($user)
        ->test(\App\Livewire\EventSeats::class, ['event' => $event])
        ->call('purchase', $seat->id)
        ->assertDispatched('seat-purchased');
}
}
