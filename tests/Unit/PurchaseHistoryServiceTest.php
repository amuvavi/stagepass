<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Models\Purchase;
use App\Models\Event;
use App\Services\PurchaseHistoryService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Carbon\Carbon;

class PurchaseHistoryServiceTest extends TestCase
{
    use RefreshDatabase;

    protected PurchaseHistoryService $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = new PurchaseHistoryService();
    }

    /** @test */
    public function it_filters_purchases_by_user_id()
    {
        $user = User::factory()->create();
        Purchase::factory()->count(2)->create(['user_id' => $user->id]);
        Purchase::factory()->count(1)->create();

        $results = $this->service->queryForUser($user->id)->get();
        $this->assertCount(2, $results);
    }

    /** @test */
    public function it_filters_by_search_term_on_event_name()
    {
        $user = User::factory()->create();
        $event = Event::factory()->create(['name' => 'Live Music Show']);
        Purchase::factory()->create(['user_id' => $user->id, 'event_id' => $event->id]);

        $results = $this->service->queryForUser($user->id, 'music')->get();
        $this->assertCount(1, $results);
    }

    /** @test */
    public function it_filters_by_date_range()
    {
        $user = User::factory()->create();
        Purchase::factory()->create(['user_id' => $user->id, 'purchased_at' => Carbon::now()->subDays(2)]);
        Purchase::factory()->create(['user_id' => $user->id, 'purchased_at' => Carbon::now()]);

        $results = $this->service->queryForUser($user->id, null, now()->subDay())->get();
        $this->assertCount(1, $results);
    }
}