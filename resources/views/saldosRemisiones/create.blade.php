@extends('layouts.tabler')

@section('content')
<div class="page-body">
  <div class="container-xl">
    <x-alert/>
    <div class="row row-cards">
      <form action="{{ route('saldosRemisiones.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
          

          <div class="col-lg-12">
            <div class="card">
              <div class="card-header">
                <div>
                    <h3 class="card-title">
                        {{ __('Crear Saldos') }}
                    </h3>
                </div>

                <div class="card-actions">
                    <a href="{{ route('saldosRemisiones.index') }}" class="btn-action">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M18 6l-12 12"></path><path d="M6 6l12 12"></path></svg>
                    </a>
                </div>
              </div>
              <div class="card-body">
                <div class="row row-cards">

                  <input type="hidden" id="tipo" value="1">
                  <div class="col-sm-6 col-md-6">
                    <div class="mb-3">
                      <label for="remision_id" class="form-label">
                        Remision
                        <span class="text-danger">*</span>
                      </label>

                      @if ($remisiones->count() === 1)
                        <select name="remision_id" id="remision_id"
                            class="form-select @error('remision_id') is-invalid @enderror"
                            readonly
                            >
                            <option selected="" >
                                Seleccione una Remision:
                            </option>
                          @foreach ($remisiones as $remision)
                              <option value="{{ $remision->id }}" >
                                  {{ $remision->finca }}
                              </option>
                          @endforeach
                        </select>
                      @else
                        <select name="remision_id" id="remision_id"
                            class="form-select @error('remision_id') is-invalid @enderror"
                            >
                            <option selected="" >
                                Seleccione una Remision:
                            </option>

                            @foreach ($remisiones as $remision)
                                <option value="{{ $remision->id }}" @if(old('remision_id') == $remision->id) selected="selected" @endif>
                                    {{ $remision->finca }}
                                </option>
                            @endforeach
                        </select>
                      @endif

                      @error('remision_id')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                      @enderror
                    </div>
                  </div>                  

                  
                  <div id="div_tabla_saldos"></div>
                </div>
              </div>

              <div class="card-footer text-end">
                <x-button.save type="submit">
                    {{ __('Guardar') }}
                </x-button.save>

                <a class="btn btn-warning" href="{{ url()->previous() }}">
                    {{ __('Cancelar') }}
                </a>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection

@pushonce('page-scripts')
    <script src="{{ asset('assets/js/img-preview.js') }}"></script>
    <script src="{{ asset('assets/js/saldos.js') }}"></script>
@endpushonce
