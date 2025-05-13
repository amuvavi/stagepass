<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Purchase;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;
use App\Services\PurchaseHistoryService;
use Livewire\Attributes\Url;

class MyPurchases extends Component
{
    use WithPagination;

    #[Url(history: true)] // optional: keeps search in URL
    public string $search = '';

    #[Url]
    public int $perPage = 10;

    #[Url]
    public ?string $dateFrom = null;

    #[Url]
    public ?string $dateTo = null;

    public function clearFilters(): void
{
    $this->reset([
        'search',
        'dateFrom',
        'dateTo',
        'perPage',
    ]);

    $this->resetPage(); // optional: resets pagination to page 1
}


     public function render()
    {
        $query = app(PurchaseHistoryService::class)
            ->queryForUser(Auth::id(), $this->search, $this->dateFrom, $this->dateTo);

        return view('livewire.my-purchases', [
            'purchases' => $query->latest('purchased_at')->paginate($this->perPage),
        ]);
    }
}
