@extends('layouts.tabler')

@section('content')
    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <div class="card-header">
                    <div>
                        <h3 class="card-title">
                            {{ __('Crear Categoria') }}
                        </h3>
                    </div>
                    <div class="card-actions">
                        <x-action.close route="{{ route('categories.index') }}" />
                    </div>
                </div>
                <form method="POST" action="{{ route('categories.store') }}">
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
