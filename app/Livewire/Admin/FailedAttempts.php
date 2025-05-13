<?php
namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\FailedAttempt;

class FailedAttempts extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 20;

    public function clearFilters(): void
    {
        $this->reset(['search', 'perPage']);
        $this->resetPage();
    }


    public function render()
    {
        $query = FailedAttempt::with(['event', 'seat', 'user'])
            ->latest('attempted_at');

        if ($this->search) {
            $query->whereHas('event', function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%');
            });
        }

        return view('livewire.admin.failed-attempts', [
            'attempts' => $query->paginate($this->perPage),
        ]);
    }
}

