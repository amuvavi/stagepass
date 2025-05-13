<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Event;
use App\Models\Seat;
use Illuminate\Support\Str;
use Carbon\Carbon;

class EventSeeder extends Seeder
{
    public function run(): void
    {
        foreach (range(1, 10) as $i) {
            $event = Event::create([
                'name' => 'Event ' . Str::random(5),
                'description' => 'Sample event number ' . $i,
                'date' => Carbon::now()->addDays($i),
                'rows' => 10,
                'columns' => 10,
            ]);

            $seats = [];

            for ($row = 1; $row <= 10; $row++) {
                for ($col = 1; $col <= 10; $col++) {
                    $seats[] = [
                        'event_id' => $event->id,
                        'row_number' => $row,
                        'column_number' => $col,
                        'status' => 'available',
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }
            }

            Seat::insert($seats);
        }
    }
}

