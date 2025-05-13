<?php
namespace App\Livewire\Admin;

use App\Models\Purchase;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class PurchasesTable extends DataTableComponent
{
    public $model = Purchase::class;
    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setSearchEnabled()
            ->setDefaultSort('purchased_at', 'desc');
    }
    

    public function columns(): array
    {
        return [
            Column::make("ID", "id")->sortable(),

            Column::make("User", 'user.name')->sortable()->searchable(),
                      
            Column::make("Event", 'event.name')->sortable()->searchable(),

            Column::make("Seat Row", 'seat.row_number')->sortable(),

            Column::make("Seat Column", 'seat.column_number')->sortable(),

            Column::make("Purchased At", "purchased_at")
                ->format(fn($value) => \Carbon\Carbon::parse($value)->format('M d, Y H:i:s') )->sortable(),

        ];
    }
}
