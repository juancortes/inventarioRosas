@extends('layouts.tabler')

@section('content')
<div class="page-body">
    <div class="container-xl">
        @livewire('tables.product-by-typeBranches-table', ['typeBranches' => $typeBranches])
    </div>
</div>
@endsection
