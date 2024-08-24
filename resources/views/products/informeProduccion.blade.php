@extends('layouts.tabler')

@section('content')
    <div class="page-body">
        <div class="container-xl">
            <x-alert />
            @livewire('tables.informeProduccion-table')
        </div>
    </div>
@endsection