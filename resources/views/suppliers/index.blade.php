@extends('layouts.tabler')

@section('content')
<div class="page-body">
    @if(!$suppliers)
        <x-empty
            title="No hay proveedores"
            button_label="{{ __('Adicionar tu primer Proveedor') }}"
            button_route="{{ route('suppliers.create') }}"
        />
    @else
        <div class="container-xl">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible" role="alert">
                    <h3 class="mb-1">Success</h3>
                    <p>{{ session('success') }}</p>

                    <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
                </div>
            @endif
            @livewire('tables.supplier-table')
        </div>
    @endif
</div>
@endsection
