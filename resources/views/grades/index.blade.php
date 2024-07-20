@extends('layouts.tabler')

@section('content')
<div class="page-body">
    @if($grades->isEmpty())
        <x-empty
            title="No hay Fincas"
            message="."
            button_label="{{ __('Adicione su primer grado') }}"
            button_route="{{ route('grades.create') }}"
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
            @livewire('tables.grades-table')
        </div>
    @endif
</div>
@endsection
