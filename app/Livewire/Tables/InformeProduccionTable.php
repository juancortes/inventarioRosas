<?php

namespace App\Livewire\Tables;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class InformeProduccionTable extends Component
{
    use WithPagination;

    public $perPage = 5;

    public $searchFechaInicial = '';
    public $searchFechaFinal = '';
    public $searchVariedad = '';

    public $sortField = 'products.id';

    public $sortAsc = true;

    public function sortBy($field): void
    {
        if($this->sortField === $field)
        {
            $this->sortAsc = ! $this->sortAsc;

        } else {
            $this->sortAsc = true;
        }

        $this->sortField = $field;
    }

    public function render()
    {
        return view('livewire.tables.informeProduccion-table', [
            'products' => Product::with(['lands', 'varietie','typeBranche','table','grades'])
                ->search2($this->searchFechaInicial, $this->searchFechaFinal, $this->searchVariedad)
                ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                ->paginate($this->perPage)
        ]);
    }
}
