@extends('layouts.tabler')

@section('content')
  <div class="page-header d-print-none">
    <div class="container-xl">
      <div class="row g-2 align-items-center mb-3">
        <div class="col">
          <h2 class="page-title">
            {{ __('Editar Saldo') }}
          </h2>
        </div>
      </div>

      @include('partials._breadcrumbs', ['model' => $saldosRemision])
    </div>
  </div>

  <div class="page-body">
    <div class="container-xl">
      <div class="row row-cards">
        <form action="{{ route('saldosRemisiones.update', $saldosRemision->id) }}" method="POST">
          @csrf
          @method('put')
          <div class="row">

            <div class="col-lg-12">
              <div class="card">
                <div class="card-body">
                  <h3 class="card-title">
                    {{ __('Detalles del Saldo') }}
                  </h3>

                  <div class="row row-cards">
                    <div class="col-sm-6 col-md-6">
                      <div class="mb-3">
                        <label for="remision_id" class="form-label">
                          Remision
                          <span class="text-danger">*</span>
                        </label>
                        <input type="hidden" id="tipo" value="1">
                        <select name="remision_id" id="remision_id"
                          class="form-select @error('remision_id') is-invalid @enderror">
                          <option selected="" disabled="">Seleccione una Remision:</option>
                          @foreach ($remisiones as $remision)
                            <option value="{{ $remision->id }}"
                                @if ( $saldosRemision->remision_id == $remision->id) selected="selected" @endif>
                                {{ $remision->finca }}</option>
                          @endforeach
                        </select>

                        @error('remision_id')
                          <div class="invalid-feedback">
                              {{ $message }}
                          </div>
                        @enderror
                      </div>
                    </div>
                  </div>
                </div>

                  <div id="div_tabla_saldos"></div>
                <div class="card-footer text-end">
                  <button class="btn btn-primary" type="submit">
                    {{ __('Actualizar') }}
                  </button>

                  <a class="btn btn-danger" href="{{ url()->previous() }}">
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
  <script type="text/javascript">
    $(document).ready(function(){
    });
  </script>
  <script src="{{ asset('assets/js/saldos.js') }}"></script>
@endpushonce
