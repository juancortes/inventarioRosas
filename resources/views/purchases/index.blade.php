@extends('layouts.tabler')

@section('content')
<div class="page-body">
    @if(!$purchases)
    <x-empty
        title="No hay compras"
        button_label="{{ __('Adicionar su primera compra') }}"
        button_route="{{ route('purchases.create') }}"
    />
    @else
    <div class="container-xl">
        @livewire('tables.purchase-table')
    @endif
</div>
@endsection
