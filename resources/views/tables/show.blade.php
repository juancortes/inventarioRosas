@extends('layouts.tabler')

@section('content')
<div class="page-body">
    <div class="container-xl">
        @livewire('tables.product-by-tables-table', ['tables' => $tables])
    </div>
</div>
@endsection
