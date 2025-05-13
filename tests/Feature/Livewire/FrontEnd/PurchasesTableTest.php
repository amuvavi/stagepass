<?php

namespace Tests\Feature\Livewire\Admin;

use App\Livewire\Admin\PurchasesTable;
use App\Models\Purchase;
use App\Models\User;
use App\Models\Seat;
use App\Models\Event;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class PurchasesTableTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_displays_purchase_with_relationships()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $event = Event::factory()->create(['name' => 'Mega Show']);
        $seat = Seat::factory()->create(['event_id' => $event->id, 'row_number' => 1, 'column_number' => 2]);
        Purchase::factory()->create([
            'user_id' => $admin->id,
            'event_id' => $event->id,
            'seat_id' => $seat->id,
        ]);

        Livewire::actingAs($admin)
            ->test(PurchasesTable::class)
            ->assertSee('Mega Show')
            ->assertSee($admin->name);
    }

    /** @test */
    public function it_filters_by_event_name()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $match = Event::factory()->create(['name' => 'Jazz Night']);
        $skip = Event::factory()->create(['name' => 'Food Expo']);

        $seat = Seat::factory()->create(['event_id' => $match->id]);
        Purchase::factory()->create(['user_id' => $admin->id, 'event_id' => $match->id, 'seat_id' => $seat->id]);

        Livewire::actingAs($admin)
            ->test(PurchasesTable::class)
            ->set('search', 'Jazz')
            ->assertSee('Jazz Night')
            ->assertDontSee('Food Expo');
    }
}
