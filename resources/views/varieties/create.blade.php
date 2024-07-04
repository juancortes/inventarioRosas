@extends('layouts.tabler')

@section('content')
<div class="page-body">
    <div class="container-xl">
        <div class="card">
            <div class="card-header">
                <div>
                    <h3 class="card-title">
                        {{ __('Crear Variedad') }}
                    </h3>
                </div>

                <div class="card-actions">
                    <x-action.close route="{{ route('varieties.index') }}" />
                </div>
            </div>

            <form action="{{ route('varieties.store') }}" method="POST">
                @csrf
                <div class="card-body">
                    <livewire:name />                   
                </div>
                <div class="card-footer text-end">
                    <x-button type="submit">
                        {{ __('Crear') }}
                    </x-button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
