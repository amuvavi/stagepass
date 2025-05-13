<?php
// app/Services/Logging/FailureLoggerService.php

namespace App\Services\Logging;

use App\Models\FailedAttempt;

class FailureLoggerService
{
    public function log(array $data): void
    {
        FailedAttempt::create([
            'user_id'     => $data['user_id'],
            'event_id'    => $data['event_id'],
            'seat_id'     => $data['seat_id'],
            'attempted_at'=> now(),
            'reason'      => $data['reason'],
        ]);
    }
}