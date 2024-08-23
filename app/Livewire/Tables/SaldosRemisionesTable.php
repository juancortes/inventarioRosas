<?php

namespace App\Livewire\Tables;

use App\Models\SaldosRemisiones;
use Livewire\Component;
use Livewire\WithPagination;

class SaldosRemisionesTable extends Component
{
    use WithPagination;

    public $perPage = 5;

    public $search = '';

    public $sortField = 'name';

    public $sortAsc = false;

    public function sortBy($field): void
    {
        if ($this->sortField === $field) {
            $this->sortAsc = !$this->sortAsc;
        } else {
            $this->sortAsc = true;
        }

        $this->sortField = $field;
    }

    public function render()
    {
        return view('livewire.tables.saldosRemisiones-table', [
            'saldosRemisiones' => SaldosRemisiones::with(['remisiones'])
                ->search($this->search)
                ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                ->paginate($this->perPage)
        ]);
    }
}
