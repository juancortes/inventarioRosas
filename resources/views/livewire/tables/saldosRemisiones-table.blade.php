<div class="card">
    <div class="card-header">
        <div>
            <h3 class="card-title">
                {{ __('Saldos') }}
            </h3>
        </div>

        <div class="card-actions btn-group">
            <div class="dropdown">
                <a href="#" class="btn-action dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    <x-icon.vertical-dots />
                </a>
                <div class="dropdown-menu dropdown-menu-end" style="">
                    <a href="{{ route('saldosRemisiones.create') }}" class="dropdown-item">
                        <x-icon.plus />
                        {{ __('Crear Saldo') }}
                    </a>
                    
                    <a href="{{ route('saldosRemisiones.export.store') }}" class="dropdown-item">
                        <x-icon.plus />
                        {{ __('Exportar Saldo') }}
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
                    <a wire:click.prevent="sortBy('produccion_freedom')" href="#" role="button">
                        {{ __('Producción Freedom') }}
                        @include('inclues._sort-icon', ['field' => 'produccion_freedom'])
                    </a>
                </th>
                <th scope="col" class="align-middle text-center">
                    <a wire:click.prevent="sortBy('produccion_color')" href="#" role="button">
                        {{ __('Producción Color') }}
                        @include('inclues._sort-icon', ['field' => 'produccion_color'])
                    </a>
                </th>
                <th scope="col" class="align-middle text-center">
                    <a wire:click.prevent="sortBy('devolucion_freedom')" href="#" role="button">
                        {{ __('Devolución Freedom') }}
                        @include('inclues._sort-icon', ['field' => 'devolucion_freedom'])
                    </a>
                </th>
                <th scope="col" class="align-middle text-center">
                    <a wire:click.prevent="sortBy('devolucion_color')" href="#" role="button">
                        {{ __('Devolución Color') }}
                        @include('inclues._sort-icon', ['field' => 'devolucion_color'])
                    </a>
                </th>
                <th scope="col" class="align-middle text-center">
                    {{ __('Accion') }}
                </th>
            </tr>
            </thead>
            <tbody>
            @forelse ($saldosRemisiones as $saldosRemision)
                <tr>
                    <td class="align-middle text-center">
                        {{ $saldosRemision->produccion_freedom }}
                    </td>
                    <td class="align-middle text-center">
                        {{ $saldosRemision->produccion_color }}
                    </td>
                    <td class="align-middle text-center">
                        {{ $saldosRemision->devolucion_freedom }}
                    </td>
                    <td class="align-middle text-center">
                        {{ $saldosRemision->devolucion_color }}
                    </td>
                    <td class="align-middle text-center" style="width: 15%">
                        <x-button.show class="btn-icon" route="{{ route('saldosRemisiones.show', $saldosRemision) }}"/>
                        <x-button.edit class="btn-icon" route="{{ route('saldosRemisiones.edit', $saldosRemision->id) }}"/>
                        <x-button.delete class="btn-icon" route="{{ route('saldosRemisiones.destroy', $saldosRemision) }}"/>
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
            Mostrando <span>{{ $saldosRemisiones->firstItem() }}</span> de <span>{{ $saldosRemisiones->lastItem() }}</span> de <span>{{ $saldosRemisiones->total() }}</span> entradas
        </p>

        <ul class="pagination m-0 ms-auto">
            {{ $saldosRemisiones->links() }}
        </ul>
    </div>
</div>
