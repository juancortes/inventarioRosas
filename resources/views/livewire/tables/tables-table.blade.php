<div class="card">
    <div class="card-header">
        <div>
            <h3 class="card-title">
                {{ __('Mesas') }}
            </h3>
        </div>

        <div class="card-actions btn-group">
            <div class="dropdown">
                <a href="#" class="btn-action dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    <x-icon.vertical-dots />
                </a>
                <div class="dropdown-menu dropdown-menu-end" style="">
                    <a href="{{ route('tables.create') }}" class="dropdown-item">
                        <x-icon.plus />
                        {{ __('Crear Mesa') }}
                    </a>
                    
                    <a href="{{ route('tables.export.store') }}" class="dropdown-item">
                        <x-icon.plus />
                        {{ __('Exportar Mesa') }}
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="card-body border-bottom py-3">
        <div class="d-flex">
            <div class="text-secondary">
                Mostrar
                <div class="mx-2 d-inline-block">
                    <select wire:model.live="perPage" class="form-select form-select-sm" aria-label="result per page">
                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="15">15</option>
                        <option value="25">25</option>
                    </select>
                </div>
                entradas
            </div>
            <div class="ms-auto text-secondary">
                Buscar:
                <div class="ms-2 d-inline-block">
                    <input type="text" wire:model.live="search" class="form-control form-control-sm" aria-label="Buscar invoice">
                </div>
            </div>
        </div>
    </div>

    <x-spinner.loading-spinner/>

    <div class="table-responsive">
        <table wire:loading.remove class="table table-bordered card-table table-vcenter text-nowrap datatable">
            <thead class="thead-light">
            <tr>
                <th scope="col" class="align-middle text-center">
                    <a wire:click.prevent="sortBy('name')" href="#" role="button">
                        {{ __('Nombre') }}
                        @include('inclues._sort-icon', ['field' => 'name'])
                    </a>
                </th>
                <th scope="col" class="align-middle text-center">
                    <a wire:click.prevent="sortBy('code')" href="#" role="button">
                        {{ __('Código') }}
                        @include('inclues._sort-icon', ['field' => 'code'])
                    </a>
                </th>
                <th scope="col" class="align-middle text-center">
                    {{ __('Accion') }}
                </th>
            </tr>
            </thead>
            <tbody>
            @forelse ($tables as $table)
                <tr>
                    <td class="align-middle text-center">
                        {{ $table->name }}
                    </td>
                    <td class="align-middle text-center">
                        {{ $table->code }}
                    </td>
                    <td class="align-middle text-center" style="width: 15%">
                        <x-button.show class="btn-icon" route="{{ route('tables.show', $table) }}"/>
                        <x-button.edit class="btn-icon" route="{{ route('tables.edit', $table->id) }}"/>
                        <x-button.delete class="btn-icon" route="{{ route('tables.destroy', $table) }}"/>
                    </td>
                </tr>
            @empty
                <tr>
                    <td class="align-middle text-center" colspan="8">
                        No hay resultados
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <div class="card-footer d-flex align-items-center">
        <p class="m-0 text-secondary d-none d-sm-block">
            Mostrando <span>{{ $tables->firstItem() }}</span> de <span>{{ $tables->lastItem() }}</span> de <span>{{ $tables->total() }}</span> entradas
        </p>

        <ul class="pagination m-0 ms-auto">
            {{ $tables->links() }}
        </ul>
    </div>
</div>
