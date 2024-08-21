<div class="card">
    <div class="card-header">
        <div>
            <h3 class="card-title">
                {{ __('Remisiones') }}
            </h3>
        </div>

        <div class="card-actions btn-group">
            <div class="dropdown">
                <a href="#" class="btn-action dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    <x-icon.vertical-dots />
                </a>
                <div class="dropdown-menu dropdown-menu-end" style="">
                    <a href="{{ route('remisiones.create') }}" class="dropdown-item">
                        <x-icon.plus />
                        {{ __('Crear Remision') }}
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
                    <input type="text" wire:model.live="search" class="form-control form-control-sm"
                        aria-label="Buscar invoice">
                </div>
            </div>
        </div>
    </div>

    <x-spinner.loading-spinner />

    <div class="table-responsive">
        <table wire:loading.remove class="table table-bordered card-table table-vcenter text-nowrap datatable">
            <thead class="thead-light">
                <tr>
                    <th class="align-middle text-center w-1">
                        {{ __('No.') }}
                    </th>
                    <th scope="col" class="align-middle text-center">
                        {{ __('Imagen') }}
                    </th>
                    <th scope="col" class="align-middle text-center">
                        <a wire:click.prevent="sortBy('date')" href="#" role="button">
                            {{ __('Fecha') }}
                            @include('inclues._sort-icon', ['field' => 'date'])
                        </a>
                    </th>
                    <th scope="col" class="align-middle text-center">
                        <a wire:click.prevent="sortBy('lands_id')" href="#" role="button">
                            {{ __('Finca') }}
                            @include('inclues._sort-icon', ['field' => 'lands_id'])
                        </a>
                    </th>
                    <th scope="col" class="align-middle text-center">
                        {{ __('Accion') }}
                    </th>
                </tr>
            </thead>
            <tbody>
                
                @forelse ($remisiones as $remision)
                    <tr>
                        <td class="align-middle text-center">
                            {{ $loop->iteration }}
                        </td>
                        <td class="align-middle text-center">
                            <img style="width: 90px;"
                                src="{{ $remision->support ? asset('storage/' . $remision->support) : asset('assets/img/remisiones/default.webp') }}"
                                alt="">
                        </td>
                        <td class="align-middle text-center">
                            {{ $remision->date }}
                        </td>
                        <td class="align-middle text-center">
                            {{ $remision->land ? $remision->land->name : '--' }}
                        </td>
                        <td class="align-middle text-center" style="width: 10%">
                            <x-button.show class="btn-icon" route="{{ route('remisiones.show', $remision) }}" />
                            <x-button.edit class="btn-icon" route="{{ route('remisiones.edit', $remision->id) }}" />
                            <x-button.delete class="btn-icon" route="{{ route('remisiones.destroy', $remision->id) }}"
                                onclick="return confirm('Esta seguro de eliminar la  remision?')" />
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td class="align-middle text-center" colspan="7">
                            No hay resultados
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="card-footer d-flex align-items-center">
        <p class="m-0 text-secondary">
            Mostrando <span>{{ $remisiones->firstItem() }}</span>
            de <span>{{ $remisiones->lastItem() }}</span> de <span>{{ $remisiones->total() }}</span> entradas
        </p>

        <ul class="pagination m-0 ms-auto">
            {{ $remisiones->links() }}
        </ul>
    </div>
</div>
