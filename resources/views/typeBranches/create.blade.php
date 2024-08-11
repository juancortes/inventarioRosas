@extends('layouts.tabler')

@section('content')
<div class="page-body">
    <div class="container-xl">
        <div class="card">
            <div class="card-header">
                <div>
                    <h3 class="card-title">
                        {{ __('Crear Tipo de Ramo') }}
                    </h3>
                </div>

                <div class="card-actions">
                    <x-action.close route="{{ route('typeBranches.index') }}" />
                </div>
            </div>

            <form action="{{ route('typeBranches.store') }}" method="POST">
                @csrf
                <div class="card-body">
                    <livewire:name />                   
                </div>
                <div class="card-body">
                    <livewire:code />                   
                </div>
                <div class="col-sm-4 col-md-4">
                    <x-input type="number"
                             label="Cantidad"
                             name="quantity"
                             id="quantity"
                             placeholder="0"
                             value="{{ old('quantity') }}"
                             required
                    />
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
