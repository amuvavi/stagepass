<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Services\SeatPurchaseSimulatorService;
use App\Jobs\AttemptSeatPurchase;
use Illuminate\Support\Facades\Bus;

class SeatPurchaseSimulatorServiceTest extends TestCase
{
    /** @test */
    public function it_dispatches_jobs_for_each_attempt()
    {
        Bus::fake();

        $service = new SeatPurchaseSimulatorService();
        $service->simulate(eventId: 1, seatId: 2, userId: 3, attempts: 5);

        Bus::assertDispatched(AttemptSeatPurchase::class, 5);
    }
}
