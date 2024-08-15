<div class="card">
    <div class="card-header">
        <div>
            <h3 class="card-title">
                {{ __('Fincas') }}
            </h3>
        </div>

        <div class="card-actions">
            <x-action.create route="{{ route('lands.create') }}" />
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
            @forelse ($lands as $land)
                <tr>
                    <td class="align-middle text-center">
                        {{ $land->name }}
                    </td>
                    <td class="align-middle text-center">
                        {{ $land->code }}
                    </td>
                    <td class="align-middle text-center" style="width: 15%">
                        <x-button.show class="btn-icon" route="{{ route('lands.show', $land) }}"/>
                        <x-button.edit class="btn-icon" route="{{ route('lands.edit', $land->id) }}"/>
                        <x-button.delete class="btn-icon" route="{{ route('lands.destroy', $land) }}"/>
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
            Mostrando <span>{{ $lands->firstItem() }}</span> de <span>{{ $lands->lastItem() }}</span> de <span>{{ $lands->total() }}</span> entradas
        </p>

        <ul class="pagination m-0 ms-auto">
            {{ $lands->links() }}
        </ul>
    </div>
</div>
