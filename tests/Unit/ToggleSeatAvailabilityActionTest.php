<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Seat;
use App\Actions\ToggleSeatAvailabilityAction;
use App\Services\SeatAvailabilityService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery;

class ToggleSeatAvailabilityActionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_calls_toggle_on_the_service()
    {
        $seat = Seat::factory()->create(['status' => 'available']);

        $mockService = Mockery::mock(SeatAvailabilityService::class);
        $mockService->shouldReceive('toggle')
            ->once()
            ->with(Mockery::type(Seat::class))
            ->andReturn($seat);

        $action = new ToggleSeatAvailabilityAction($mockService);
        $result = $action->execute($seat->id);

        $this->assertEquals($seat->id, $result->id);
    }
}
