@extends('layouts.tabler')

@section('content')
<div class="page-body">
    <div class="container-xl">
        @livewire('tables.product-by-lands-table', ['lands' => $lands])
    </div>
</div>
@endsection
