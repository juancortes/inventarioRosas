@extends('layouts.tabler')

@section('content')
  <div class="page-header d-print-none">
    <div class="container-xl">
      <div class="row g-2 align-items-center mb-3">
        <div class="col">
          <h2 class="page-title">
            {{ __('Editar Remision') }}
          </h2>
        </div>
      </div>

      @include('partials._breadcrumbs', ['model' => $remision])
    </div>
  </div>

  <div class="page-body">
    <div class="container-xl">
      <div class="row row-cards">
        <form action="{{ route('remisiones.update', $remision->id) }}" method="POST" enctype="multipart/form-data">
          @csrf
          @method('put')
          <div class="row">
            <div class="col-lg-12">
              <div class="card">
                <div class="card-body">
                  <h3 class="card-title">
                    {{ __('Detalles de la Remision') }}
                  </h3>

                  <div class="row row-cards">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="date" class="form-label">
                                {{ __('Fecha') }}
                                <span class="text-danger">*</span>
                            </label>

                            <input type="date" id="date" name="date"
                                class="form-control @error('date') is-invalid @enderror"
                                placeholder="Fecha" value="{{ old('date', $remision->date) }}">

                            @error('date')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-6">
                      <div class="mb-3">
                        <label for="lands_id" class="form-label">
                          Finca
                          <span class="text-danger">*</span>
                        </label>

                        <select name="lands_id" id="lands_id"
                          class="form-select @error('lands_id') is-invalid @enderror">
                          <option selected="" disabled="">Seleccione una Finca:</option>
                          @foreach ($lands as $land)
                            <option value="{{ $land->id }}"
                                @if (old('lands_id', $remision->lands_id) == $land->id) selected="selected" @endif>
                                {{ $land->name }}</option>
                          @endforeach
                        </select>

                        @error('lands_id')
                          <div class="invalid-feedback">
                              {{ $message }}
                          </div>
                        @enderror
                      </div>
                    </div>

                    <div id="table_rows">
                      <table class="table" id="table-data">
                        <thead>
                          <tr>
                            <th>Variedad</th>
                            <th>Cantidad</th>
                            <th>Opción</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($detalleRem as $detalle)
                            <tr class="tr_clone">
                              <td>
                                <select name="variety[]" id="variety"
                                class="form-select @error('variety') is-invalid @enderror"
                                >
                                  <option selected="" value="">
                                      Seleccione una Variedad:
                                  </option>

                                  @foreach ($varieties as $variety)
                                      <option value="{{ $variety->id }}" @if(old('variety', $detalle->variety_id) == $variety->id) selected="selected" @endif>
                                          {{ $variety->name }}
                                      </option>
                                  @endforeach
                                </select>
                              </td>
                              <td>
                                <input type="number"
                                 class="form-control" 
                                 name="quantity_stems[]"
                                 id="quantity_stems"
                                 placeholder="0"
                                 value="{{$detalle->quantity_stems}}" 
                                />
                              </td>
                              <td>
                                <input type="button" name="add" value="Adicionar" class="addBtn btn btn-info">
                                <input type="button" name="delete" value="Eliminar" class="removeBtn btn btn-info">
                              </td>
                            </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>

                    <div class="col-md-12">
                        <div class="mb-3 mb-0">
                            <label for="observations" class="form-label">
                                {{ __('Observaciones') }}
                            </label>

                            <textarea name="observations" id="observations" rows="5" class="form-control @error('observations') is-invalid @enderror"
                                placeholder="Observaciones">{{ old('observations', $remision->observations) }}</textarea>

                            @error('observations')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                  </div>
                </div>

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
    <script src="{{ asset('assets/js/resource.js') }}"></script>
@endpushonce
