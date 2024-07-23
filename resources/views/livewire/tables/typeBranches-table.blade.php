<div class="card">
    <div class="card-header">
        <div>
            <h3 class="card-title">
                {{ __('Tipo de Ramo') }}
            </h3>
        </div>

        <div class="card-actions">
            <x-action.create route="{{ route('typeBranches.create') }}" />
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
                <th class="align-middle text-center w-1">
                    {{ __('ID') }}
                </th>
                <th scope="col" class="align-middle text-center">
                    <a wire:click.prevent="sortBy('name')" href="#" role="button">
                        {{ __('Nombre') }}
                        @include('inclues._sort-icon', ['field' => 'name'])
                    </a>
                </th>
                <th scope="col" class="align-middle text-center">
                    {{ __('Accion') }}
                </th>
            </tr>
            </thead>
            <tbody>
            @forelse ($typeBranches as $typeBranche)
                <tr>
                    <td class="align-middle text-center" style="width: 10%">
                        {{ $loop->index }}
                    </td>
                    <td class="align-middle text-center">
                        {{ $typeBranche->name }}
                    </td>
                    <td class="align-middle text-center" style="width: 15%">
                        <x-button.show class="btn-icon" route="{{ route('typeBranches.show', $typeBranche) }}"/>
                        <x-button.edit class="btn-icon" route="{{ route('typeBranches.edit', $typeBranche->id) }}"/>
                        <x-button.delete class="btn-icon" route="{{ route('typeBranches.destroy', $typeBranche) }}"/>
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
            Mostrando <span>{{ $typeBranches->firstItem() }}</span> de <span>{{ $typeBranches->lastItem() }}</span> de <span>{{ $typeBranches->total() }}</span> entradas
        </p>

        <ul class="pagination m-0 ms-auto">
            {{ $typeBranches->links() }}
        </ul>
    </div>
</div>
