<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;

class UsersTable extends DataTableComponent
{
   public function configure(): void
{
    
   
    $this->setPrimaryKey('id')
         ->setDefaultSort('created_at', 'desc')
         ->setTableAttributes([
             'class' => 'min-w-full divide-y divide-gray-200 table-auto',
         ])
         ->setThAttributes(function(Column $column) {
             return [
                 'class' => 'px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider',
             ];
         })
         ->setTdAttributes(function(Column $column) {
             return [
                 'class' => 'px-6 py-4 whitespace-nowrap text-sm text-gray-700',
             ];
         });
}


    public function columns(): array
    {
        return [
            Column::make("ID", "id")->sortable(),
            Column::make("Name", "name")->searchable()->sortable(),
            Column::make("Email", "email")->searchable()->sortable(),
            Column::make("Role", "role")->sortable(),
            Column::make("Created", "created_at")->sortable(),

             // ✅ Add Actions Column
        Column::make("Actions")
            ->label(
                fn ($row) => view('livewire.admin.partials.user-actions', ['user' => $row])
            )->html(),
        ];
    }

    public function builder(): Builder
    {
        return User::query();
        
    }
}
