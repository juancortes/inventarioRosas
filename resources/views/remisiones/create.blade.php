@extends('layouts.tabler')

@section('content')
<div class="page-body">
  <div class="container-xl">
    <x-alert/>
    <div class="row row-cards">
      <form action="{{ route('remisiones.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
          

          <div class="col-lg-12">
            <div class="card">
              <div class="card-header">
                <div>
                    <h3 class="card-title">
                        {{ __('Crear Remision') }}
                    </h3>
                </div>

                <div class="card-actions">
                    <a href="{{ route('remisiones.index') }}" class="btn-action">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M18 6l-12 12"></path><path d="M6 6l12 12"></path></svg>
                    </a>
                </div>
              </div>
              <div class="card-body">
                <div class="row row-cards">

                  <div class="col-sm-6 col-md-6">
                    <x-input type="date"
                             label="Fecha"
                             name="date"
                             id="date"
                             placeholder="0"
                             value="{{ old('date') }}"
                    />
                  </div>

                  <div class="col-sm-6 col-md-6">
                    <div class="mb-3">
                      <label for="lands_id" class="form-label">
                        Finca
                        <span class="text-danger">*</span>
                      </label>

                      @if ($lands->count() === 1)
                        <select name="lands_id" id="lands_id"
                            class="form-select @error('lands_id') is-invalid @enderror"
                            readonly
                            >
                            <option selected="" >
                                Seleccione una Finca:
                            </option>
                          @foreach ($lands as $land)
                              <option value="{{ $land->id }}" >
                                  {{ $land->name }}
                              </option>
                          @endforeach
                        </select>
                      @else
                        <select name="lands_id" id="lands_id"
                            class="form-select @error('lands_id') is-invalid @enderror"
                            >
                            <option selected="" >
                                Seleccione una Finca:
                            </option>

                            @foreach ($lands as $land)
                                <option value="{{ $land->id }}" @if(old('lands_id') == $land->id) selected="selected" @endif>
                                    {{ $land->name }}
                                </option>
                            @endforeach
                        </select>
                      @endif

                      @error('lands_id')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                      @enderror
                    </div>
                  </div>

                  <div class="col-sm-6 col-md-6">
                    <x-input name="variety"
                             id="variety"
                             placeholder="Variedad"
                             value="{{ old('name') }}"
                             label="Variedad"
                    />
                  </div>

                  <div class="col-sm-6 col-md-6">
                    <x-input type="number"
                             label="Cantidad de Tallos"
                             name="quantity_stems"
                             id="quantity_stems"
                             placeholder="0"
                             value="{{ old('quantity_stems') }}"
                    />
                  </div>


                  <input
                    type="file"
                    accept="image/*"
                    id="image"
                    name="support"
                    class="form-control @error('support') is-invalid @enderror"
                    onchange="previewImage();"
                  >

                  <div class="col-md-12">
                      <div class="mb-3">
                          <label for="observations" class="form-label">
                              {{ __('Observaciones') }}
                          </label>

                          <textarea name="observations"
                                    id="observations"
                                    rows="5"
                                    class="form-control @error('observations') is-invalid @enderror"
                                    placeholder="Notas"
                          ></textarea>

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
@endpushonce
