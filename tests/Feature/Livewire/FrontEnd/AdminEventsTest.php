<?php

namespace Tests\Feature\Livewire\Admin;

use App\Livewire\Admin\Events;
use App\Models\User;
use App\Models\Event;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class AdminEventsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function admin_can_create_event()
    {
        $admin = User::factory()->create(['role' => 'admin']);

        Livewire::actingAs($admin)
            ->test(Events::class)
            ->set('name', 'Admin Festival')
            ->set('description', 'A big event')
            ->set('date', now()->addDays(5)->format('Y-m-d\TH:i'))
            ->set('rows', 5)
            ->set('columns', 5)
            ->call('save')
            ->assertDispatched('event-saved');

        $this->assertDatabaseHas('events', ['name' => 'Admin Festival']);
    }

    /** @test */
    public function admin_cannot_create_event_with_invalid_data()
    {
        $admin = User::factory()->create(['role' => 'admin']);

        Livewire::actingAs($admin)
            ->test(Events::class)
            ->set('name', '')
            ->set('date', '')
            ->call('save')
            ->assertHasErrors(['name', 'date']);
    }

    /** @test */
    public function admin_can_delete_event()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $event = Event::factory()->create();

        Livewire::actingAs($admin)
            ->test(Events::class)
            ->call('delete', $event->id)
            ->assertDispatched('event-deleted');

        $this->assertDatabaseMissing('events', ['id' => $event->id]);
    }
}
