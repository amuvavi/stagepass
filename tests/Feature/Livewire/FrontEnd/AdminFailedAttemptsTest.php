<?php

namespace Tests\Feature\Livewire\Admin;

use App\Livewire\Admin\FailedAttempts;
use App\Models\FailedAttempt;
use App\Models\Event;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class AdminFailedAttemptsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_renders_failed_attempts()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $event = Event::factory()->create(['name' => 'Jazz Fest']);
        FailedAttempt::factory()->create(['event_id' => $event->id]);

        Livewire::actingAs($admin)
            ->test(FailedAttempts::class)
            ->assertSee('Jazz Fest');
    }

    /** @test */
    public function it_filters_attempts_by_event_name()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $match = Event::factory()->create(['name' => 'Rock Show']);
        $skip = Event::factory()->create(['name' => 'Tech Talk']);

        FailedAttempt::factory()->create(['event_id' => $match->id]);
        FailedAttempt::factory()->create(['event_id' => $skip->id]);

        Livewire::actingAs($admin)
            ->test(FailedAttempts::class)
            ->set('search', 'Rock')
            ->assertSee('Rock Show')
            ->assertDontSee('Tech Talk');
    }
}
