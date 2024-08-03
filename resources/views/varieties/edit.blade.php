@extends('layouts.tabler')

@section('content')
<div class="page-body">
    <div class="container-xl">
        <div class="card">
            <div class="card-header">
                <div>
                    <h3 class="card-title">
                        {{ __('Editar Variedad') }}

                    </h3>
                </div>

                <div class="card-actions">
                    <x-action.close route="{{ route('varieties.index') }}" />
                </div>
            </div>
            <form action="{{ route('varieties.update', $varieties->id) }}" method="POST">
                @csrf
                @method('put')

                <div class="card-body">
                    <x-input
                        label="{{ __('Nombre Finca') }}"
                        id="name"
                        name="name"
                        :value="old('name', $varieties->name)"
                        required
                    />
                </div>
                <div class="card-body">
                    <x-input
                        label="{{ __('Código') }}"
                        id="code"
                        name="code"
                        :value="old('code', $varieties->code)"
                        required
                    />
                </div>
                <div class="card-footer text-end">
                    <x-button type="submit">
                        {{ __('Actualizar') }}
                    </x-button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@pushonce('page-scripts')
<script>
    // Slug Generator
    const title = document.querySelector("#name");
    const slug = document.querySelector("#slug");
    title.addEventListener("keyup", function() {
        let preslug = title.value;
        preslug = preslug.replace(/ /g,"-");
        slug.value = preslug.toLowerCase();
    });
</script>
@endpushonce
