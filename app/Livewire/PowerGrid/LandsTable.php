<?php

namespace App\Livewire\PowerGrid;

use App\Models\Lands;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Footer;
use PowerComponents\LivewirePowerGrid\Header;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridColumns;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;

final class CategoriesTable extends PowerGridComponent
{
    public int $perPage = 5;
    public array $perPageValues = [0, 5, 10, 20, 50];

    public function setUp(): array
    {
        return [
            Header::make()
                ->showSearchInput(),
            Footer::make()
                ->showPerPage($this->perPage, $this->perPageValues)
                ->showRecordCount(),
        ];
    }

    public function datasource(): Builder
    {
        return Lands::query();
    }

    public function addColumns(): PowerGridColumns
    {
        return PowerGrid::columns()
            ->addColumn('id')
            ->addColumn('name')
            ->addColumn('created_at')
            ->addColumn('created_at_formatted', fn (Category $model) => Carbon::parse($model->created_at)->format('d/m/Y'));
    }

    public function columns(): array
    {
        return [
            Column::make('ID', 'id')
                ->headerAttribute('align-middle text-center')
                ->bodyAttribute('align-middle text-center')
                ->searchable()
                ->sortable(),

            Column::make('Name', 'name')
                ->headerAttribute('align-middle text-center')
                ->bodyAttribute('align-middle text-center')
                ->searchable()
                ->sortable(),

            

            Column::make('Creado', 'created_at')
                ->headerAttribute('align-middle text-center')
                ->bodyAttribute('align-middle text-center')
                ->hidden(),

            Column::make('Creado', 'created_at_formatted', 'created_at')
                ->headerAttribute('align-middle text-center')
                ->bodyAttribute('align-middle text-center')
                ->searchable(),

            Column::action('Action')
                ->headerAttribute('text-center', styleAttr: 'width: 150px;')
                ->bodyAttribute('text-center d-flex justify-content-around')
        ];
    }

    public function filters(): array
    {
        return [
//            Filter::inputText('name'),
//            Filter::datepicker('created_at_formatted', 'created_at'),
        ];
    }

    public function actions(\App\Models\Lands $row): array
    {
        return [
            Button::make('show', file_get_contents('assets/svg/eye.svg'))
//                ->slot('Show')
                ->class('btn btn-outline-info btn-icon w-100')
                ->tooltip('Mostrar Detalles de Finca')
                ->route('lands.show', ['lands' => $row])
                ->method('get'),

            Button::make('edit', file_get_contents('assets/svg/edit.svg'))
                ->class('btn btn-outline-warning btn-icon w-100')
                ->route('landss.edit', ['lands' => $row])
                ->method('get')
                ->tooltip('Editar Finca'),

            Button::add('delete')
                ->slot(file_get_contents('assets/svg/trash.svg'))
                ->class('btn btn-outline-danger btn-icon w-100')
                ->tooltip('Borrar Finca')
                ->route('lands.destroy', ['lands' => $row])
                ->method('delete'),
        ];
    }
}
