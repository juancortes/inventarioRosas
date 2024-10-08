@extends('layouts.tabler')

@section('content')
    <div class="page-body">
        @if (!$categories)
            <x-empty title="No hay Tipo de empaque"
                button_label="{{ __('Add your first Tipo de empaqeu') }}" button_route="{{ route('categories.create') }}" />
        @else
            
            <div class="container-xl">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <h3 class="mb-1">Success</h3>
                        <p>{{ session('success') }}</p>

                        <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
                    </div>
                @endif
                @livewire('tables.category-table')
            </div>
        @endif
    </div>
@endsection
