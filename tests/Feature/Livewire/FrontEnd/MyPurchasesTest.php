<?php

namespace Tests\Feature\Livewire\FrontEnd;

use App\Livewire\MyPurchases;
use App\Models\Purchase;
use App\Models\User;
use App\Models\Event;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;
use Carbon\Carbon;

class MyPurchasesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_shows_logged_in_users_purchases()
    {
        $user = User::factory()->create();
        $event = Event::factory()->create(['name' => 'Concert']);
        Purchase::factory()->create(['user_id' => $user->id, 'event_id' => $event->id]);

        Livewire::actingAs($user)
            ->test(MyPurchases::class)
            ->assertSee('Concert');
    }

    /** @test */
    public function it_filters_by_event_name()
    {
        $user = User::factory()->create();
        $matchEvent = Event::factory()->create(['name' => 'Gospel Fest']);
        $skipEvent = Event::factory()->create(['name' => 'Metal Bash']);
        
        Purchase::factory()->create(['user_id' => $user->id, 'event_id' => $matchEvent->id]);
        Purchase::factory()->create(['user_id' => $user->id, 'event_id' => $skipEvent->id]);

        Livewire::actingAs($user)
            ->test(MyPurchases::class)
            ->set('search', 'Gospel')
            ->assertSee('Gospel Fest')
            ->assertDontSee('Metal Bash');
    }

    /** @test */
    public function it_filters_by_date_range()
    {
        $user = User::factory()->create();
        $eventOld = Event::factory()->create(['name' => 'Old Event']);
        $eventRecent = Event::factory()->create(['name' => 'Recent Event']);

        Purchase::factory()->create([
            'user_id' => $user->id,
            'event_id' => $eventOld->id,
            'purchased_at' => Carbon::now()->subDays(3),
        ]);

        Purchase::factory()->create([
            'user_id' => $user->id,
            'event_id' => $eventRecent->id,
            'purchased_at' => Carbon::now(),
        ]);

        Livewire::actingAs($user)
            ->test(MyPurchases::class)
            ->set('dateFrom', now()->subDay()->toDateString())
            ->assertSee('Recent Event')
            ->assertDontSee('Old Event');
    }
}