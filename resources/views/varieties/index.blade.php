@extends('layouts.tabler')

@section('content')
<div class="page-body">
    @if($varieties->isEmpty())
        <x-empty
            title="No hay Variedades"
            message="."
            button_label="{{ __('Adicione su primera variedad') }}"
            button_route="{{ route('varieties.create') }}"
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
            @livewire('tables.varieties-table')
        </div>
    @endif
</div>
@endsection
