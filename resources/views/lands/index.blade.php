@extends('layouts.tabler')

@section('content')
<div class="page-body">
    @if($lands->isEmpty())
        <x-empty
            title="No hay Fincas"
            message="."
            button_label="{{ __('Adicione su primera finca') }}"
            button_route="{{ route('lands.create') }}"
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
            @livewire('tables.lands-table')
        </div>
    @endif
</div>
@endsection
