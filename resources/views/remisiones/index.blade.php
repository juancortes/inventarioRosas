@extends('layouts.tabler')

@section('content')
    <div class="page-body">
        @if (!$remisiones)
            <x-empty title="No remisiones encontradas" 
                message="."
                button_label="{{ __('Adicione su primera Ramision') }}" 
                button_route="{{ route('remisiones.create') }}" />

            
        @else
            <div class="container-xl">
                <x-alert />
                @livewire('tables.remisiones-table')
            </div>
        @endif
    </div>
@endsection
