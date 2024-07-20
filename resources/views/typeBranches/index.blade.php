@extends('layouts.tabler')

@section('content')
<div class="page-body">
    @if($typeBranches->isEmpty())
        <x-empty
            title="No hay Tipo de Ramos"
            message="."
            button_label="{{ __('Adicione su primera Tipo de Ramo') }}"
            button_route="{{ route('typeBranches.create') }}"
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
            @livewire('tables.typeBranches-table')
        </div>
    @endif
</div>
@endsection
