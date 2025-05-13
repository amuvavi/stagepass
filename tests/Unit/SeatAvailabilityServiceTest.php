<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Seat;
use App\Services\SeatAvailabilityService;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SeatAvailabilityServiceTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_toggles_seat_from_available_to_unavailable()
    {
        $seat = Seat::factory()->create(['status' => 'available']);

        $service = new SeatAvailabilityService();
        $updated = $service->toggle($seat);

        $this->assertEquals('unavailable', $updated->fresh()->status);
    }

    /** @test */
    public function it_toggles_seat_from_unavailable_to_available()
    {
        $seat = Seat::factory()->create(['status' => 'unavailable']);

        $service = new SeatAvailabilityService();
        $updated = $service->toggle($seat);

        $this->assertEquals('available', $updated->fresh()->status);
    }

    /** @test */
    public function it_throws_exception_when_toggling_sold_seat()
    {
        $this->expectException(ValidationException::class);

        $seat = Seat::factory()->create(['status' => 'sold']);
        $service = new SeatAvailabilityService();
        $service->toggle($seat);
    }
}
