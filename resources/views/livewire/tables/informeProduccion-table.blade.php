<div class="card">
    <div class="card-header">
        <div>
            <h3 class="card-title">
                {{ __('Informe') }}
            </h3>
        </div>

        <div class="card-actions btn-group">
            <div class="dropdown">
                <a href="#" class="btn-action dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    <x-icon.vertical-dots />
                </a>
                
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
                Fecha Inicial:
                <div class="ms-2 d-inline-block">
                    <input type="date" wire:model.live="searchFechaInicial" class="form-control form-control-sm"
                        aria-label="Buscar invoice">
                </div>
                Fecha Final:
                <div class="ms-2 d-inline-block">
                    <input type="date" wire:model.live="searchFechaFinal" class="form-control form-control-sm"
                        aria-label="Buscar invoice">
                </div>
                Variedad:
                <div class="ms-2 d-inline-block">
                    <input type="text" wire:model.live="searchVariedad" class="form-control form-control-sm"
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
                    <th scope="col" class="align-middle text-center">
                        <a wire:click.prevent="sortBy('date')" href="#" role="button">
                            {{ __('Fecha') }}
                            @include('inclues._sort-icon', ['field' => 'date'])
                        </a>
                    </th>
                    <th scope="col" class="align-middle text-center">
                        <a wire:click.prevent="sortBy('code')" href="#" role="button">
                            {{ __('Finca') }}
                            @include('inclues._sort-icon', ['field' => 'code'])
                        </a>
                    </th>
                    <th scope="col" class="align-middle text-center">
                        <a wire:click.prevent="sortBy('category_id')" href="#" role="button">
                            {{ __('Variedad') }}
                            @include('inclues._sort-icon', ['field' => 'category_id'])
                        </a>
                    </th>
                    <th scope="col" class="align-middle text-center">
                        <a wire:click.prevent="sortBy('quantity')" href="#" role="button">
                            {{ __('Tipo de Ramo') }}
                            @include('inclues._sort-icon', ['field' => 'quantity'])
                        </a>
                    </th>
                    <th scope="col" class="align-middle text-center">
                        <a wire:click.prevent="sortBy('quantity')" href="#" role="button">
                            {{ __('Mesa') }}
                            @include('inclues._sort-icon', ['field' => 'quantity'])
                        </a>
                    </th>
                    <th scope="col" class="align-middle text-center">
                        <a wire:click.prevent="sortBy('quantity')" href="#" role="button">
                            {{ __('Grados') }}
                            @include('inclues._sort-icon', ['field' => 'quantity'])
                        </a>
                    </th>
                    <th scope="col" class="align-middle text-center">
                        <a wire:click.prevent="sortBy('quantity')" href="#" role="button">
                            {{ __('Cantidad de Tallos') }}
                            @include('inclues._sort-icon', ['field' => 'quantity'])
                        </a>
                    </th>
                </tr>
            </thead>
            <tbody>
                @php
                    $cantidad = 0;
                @endphp
                @forelse ($products as $product)
                    @php
                        $cantidad += $product->typeBranche ? $product->typeBranche->quantity : 0;
                    @endphp
                    <tr>
                        <td class="align-middle text-center">
                            {{ date('Y-m-d', strtotime($product->date)) }}
                        </td>
                        <td class="align-middle texdate('d-m-Y', strtotime($user->from_date))t-center">
                            {{ $product->lands ? $product->lands->name : '--' }}
                        </td>
                        <td class="align-middle text-center">
                            {{ $product->varietie ? $product->varietie->name : '--' }}
                        </td>
                        <td class="align-middle text-center">
                            {{ $product->typeBranche ? $product->typeBranche->name : '--' }}
                        </td>
                        <td class="align-middle text-center">
                            {{ $product->table ? $product->table->name : '--' }}
                        </td>
                        <td class="align-middle text-center">
                            {{ $product->grades ? $product->grades->name : '--' }}
                        </td>
                        <td class="align-middle text-center">
                            {{ $product->typeBranche ? $product->typeBranche->quantity : '--' }}
                        </td>
                    </tr>
                    
                @empty
                    <tr>
                        <td class="align-middle text-center" colspan="7">
                            No hay resultados
                        </td>
                    </tr>
                @endforelse
                <tr>
                    <td colspan="6" class="align-middle text-center">
                        Total Cantidad de Tallos
                    </td>
                    <td class="align-middle text-center">
                        {{ $cantidad }}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="card-footer d-flex align-items-center">
        <p class="m-0 text-secondary">
            Mostrando <span>{{ $products->firstItem() }}</span>
            de <span>{{ $products->lastItem() }}</span> de <span>{{ $products->total() }}</span> entradas
        </p>

        <ul class="pagination m-0 ms-auto">
            {{ $products->links() }}
        </ul>
    </div>
</div>