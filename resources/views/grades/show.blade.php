@extends('layouts.tabler')

@section('content')
<div class="page-body">
    <div class="container-xl">
        @livewire('tables.product-by-grades-table', ['grades' => $grades])
    </div>
</div>
@endsection
