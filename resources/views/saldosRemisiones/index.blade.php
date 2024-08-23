@extends('layouts.tabler')

@section('content')
    <div class="page-body">
        @if (!$saldosRemisiones)
            <x-empty title="No saldos encontradas" 
                message="."
                button_label="{{ __('Adicione su primer saldo') }}" 
                button_route="{{ route('saldosRemisiones.create') }}" />

            
        @else
            <div class="container-xl">
                <x-alert />
                @livewire('tables.saldosRemisiones-table')
            </div>
        @endif
    </div>
@endsection
