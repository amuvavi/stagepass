<?php

namespace App\Services;

use App\Models\Purchase;
use Illuminate\Database\Eloquent\Builder;

class PurchaseHistoryService
{
    public function queryForUser(int $userId, ?string $search = null, ?string $from = null, ?string $to = null): Builder
    {
        $query = Purchase::with(['event', 'seat'])
            ->where('user_id', $userId);

        if ($search) {
            $query->whereHas('event', function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%');
            });
        }

        if ($from) {
            $query->whereDate('purchased_at', '>=', $from);
        }

        if ($to) {
            $query->whereDate('purchased_at', '<=', $to);
        }

        return $query;
    }
}