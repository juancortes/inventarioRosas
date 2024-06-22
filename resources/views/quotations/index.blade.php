@extends('layouts.tabler')

@section('content')
    <div class="page-body">
        @if(!$quotations)
            <x-empty
                title="No quotations found"
                button_label="{{ __('Add your first Quotation') }}"
                button_route="{{ route('quotations.create') }}"
            />
        @else
            <div class="container-xl">
                @livewire('tables.quotation-table')
            </div>
        @endif
    </div>
@endsection
