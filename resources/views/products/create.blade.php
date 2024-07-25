@extends('layouts.tabler')

@section('content')
<div class="page-body">
  <div class="container-xl">
    <x-alert/>
    <div class="row row-cards">
      <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
          <div class="col-lg-4">
            <div class="card">
              <div class="card-body">
                <h3 class="card-title">
                    {{ __('Imagen del Ramo') }}
                </h3>

                <img class="img-account-profile mb-2" src="{{ asset('assets/img/products/default.webp') }}" alt="" id="image-preview" />

                <div class="small font-italic text-muted mb-2">
                    JPG or PNG no mas largo que 2 MB
                </div>

                <input
                    type="file"
                    accept="image/*"
                    id="image"
                    name="product_image"
                    class="form-control @error('product_image') is-invalid @enderror"
                    onchange="previewImage();"
                >

                @error('product_image')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
              </div>
            </div>
          </div>

          <div class="col-lg-8">
            <div class="card">
              <div class="card-header">
                <div>
                    <h3 class="card-title">
                        {{ __('Crear Ramo') }}
                    </h3>
                </div>

                <div class="card-actions">
                    <a href="{{ route('products.index') }}" class="btn-action">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M18 6l-12 12"></path><path d="M6 6l12 12"></path></svg>
                    </a>
                </div>
              </div>
              <div class="card-body">
                <div class="row row-cards">
                  <div class="col-md-12">
                    <x-input name="name"
                             id="name"
                             placeholder="Nombre del Ramo"
                             value="{{ old('name') }}"
                             label="Nombre del Ramo"
                    />
                  </div>

                  <div class="col-sm-6 col-md-6">
                    <div class="mb-3">
                      <label for="category_id" class="form-label">
                          Tipo Empaque
                          <span class="text-danger">*</span>
                      </label>

                      @if ($categories->count() === 1)
                        <select name="category_id" id="category_id"
                            class="form-select @error('category_id') is-invalid @enderror"
                            readonly
                            >
                          @foreach ($categories as $category)
                              <option value="{{ $category->id }}" selected>
                                  {{ $category->name }}
                              </option>
                          @endforeach
                        </select>
                      @else
                        <select name="category_id" id="category_id"
                            class="form-select @error('category_id') is-invalid @enderror"
                            >
                            <option selected="" disabled="">
                                Seleccione un Tipo:
                            </option>

                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" @if(old('category_id') == $category->id) selected="selected" @endif>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                      @endif

                      @error('category_id')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                      @enderror
                    </div>
                  </div>

                  <div class="col-sm-6 col-md-6">
                    <x-input type="text"
                             label="Consecutivo"
                             name="consecutive"
                             id="consecutive"
                             placeholder="Consecutivo"
                             value="{{ old('consecutive') }}"
                    />
                  </div>

                  <div class="col-sm-6 col-md-6">
                    <div class="mb-3">
                      <label for="lands_id" class="form-label">
                        Finca
                        <span class="text-danger">*</span>
                      </label>

                      @if ($varieties->count() === 1)
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
                    <div class="mb-3">
                      <label for="varietie_id" class="form-label">
                          Variedad
                          <span class="text-danger">*</span>
                      </label>

                      @if ($varieties->count() === 1)
                        <select name="varietie_id" id="varietie_id"
                            class="form-select @error('varietie_id') is-invalid @enderror"
                            readonly
                            >
                            <option selected="" >
                                Seleccione una variedad:
                            </option>
                          @foreach ($varieties as $variety)
                              <option value="{{ $variety->id }}" >
                                  {{ $variety->name }}
                              </option>
                          @endforeach
                        </select>
                      @else
                        <select name="varietie_id" id="varietie_id"
                            class="form-select @error('varietie_id') is-invalid @enderror"
                            >
                            <option selected="" >
                                Seleccione una variedad:
                            </option>

                            @foreach ($varieties as $variety)
                                <option value="{{ $variety->id }}" @if(old('varietie_id') == $variety->id) selected="selected" @endif>
                                    {{ $variety->name }}
                                </option>
                            @endforeach
                        </select>
                      @endif

                      @error('varietie_id')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                      @enderror
                    </div>
                  </div>

                  <div class="col-sm-6 col-md-6">
                    <div class="mb-3">
                      <label for="type_branche_id" class="form-label">
                          Tipo de Ramo
                          <span class="text-danger">*</span>
                      </label>

                      @if ($type_branches->count() === 1)
                        <select name="type_branche_id" id="type_branche_id"
                            class="form-select @error('type_branche_id') is-invalid @enderror"
                            readonly
                            >
                            <option selected="" >
                                Seleccione una variedad:
                            </option>
                          @foreach ($type_branches as $type_branche)
                              <option value="{{ $type_branche->id }}" >
                                  {{ $type_branche->name }}
                              </option>
                          @endforeach
                        </select>
                      @else
                        <select name="type_branche_id" id="type_branche_id"
                            class="form-select @error('type_branche_id') is-invalid @enderror"
                            >
                            <option selected="" >
                                Seleccione una variedad:
                            </option>

                            @foreach ($type_branches as $type_branche)
                                <option value="{{ $type_branche->id }}" @if(old('type_branche_id') == $type_branche->id) selected="selected" @endif>
                                    {{ $type_branche->name }}
                                </option>
                            @endforeach
                        </select>
                      @endif

                      @error('type_branche_id')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                      @enderror
                    </div>
                  </div>

                  <div class="col-sm-6 col-md-6">
                    <div class="mb-3">
                      <label for="table_id" class="form-label">
                          Mesa
                          <span class="text-danger">*</span>
                      </label>

                      @if ($tables->count() === 1)
                        <select name="table_id" id="table_id"
                            class="form-select @error('table_id') is-invalid @enderror"
                            readonly
                            >
                          @foreach ($tables as $table)
                              <option value="{{ $table->id }}" selected>
                                  {{ $table->name }}
                              </option>
                          @endforeach
                        </select>
                      @else
                        <select name="table_id" id="table_id"
                            class="form-select @error('table_id') is-invalid @enderror"
                            >
                            <option selected="" disabled="">
                                Seleccione una Mesa:
                            </option>

                            @foreach ($tables as $table)
                                <option value="{{ $table->id }}" @if(old('table_id') == $table->id) selected="selected" @endif>
                                    {{ $table->name }}
                                </option>
                            @endforeach
                        </select>
                      @endif

                      @error('table_id')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                      @enderror
                    </div>
                  </div>

                  <div class="col-sm-6 col-md-6">
                    <div class="mb-3">
                      <label class="form-label" for="grades_id">
                        {{ __('Grado') }}
                      </label>

                      <select name="grades_id" id="grades_id"
                          class="form-select @error('grades_id') is-invalid @enderror"
                          >
                        <option selected="" disabled="">
                            Seleccione un Grado:
                        </option>
                        @foreach ($grades as $grade)
                            <option value="{{ $grade->id }}" @if(old('grades_id') == $grade->id) selected="selected" @endif>
                                {{ $grade->name }}
                            </option>
                        @endforeach
                      </select>

                      @error('grades_id')
                      <div class="invalid-feedback">
                          {{ $message }}
                      </div>
                      @enderror
                    </div>
                  </div>

                  <div class="col-sm-6 col-md-6">
                    <x-input type="number"
                             label="Cantidad de Tallos"
                             name="quantity"
                             id="quantity"
                             placeholder="0"
                             value="{{ old('quantity') }}"
                    />
                  </div>

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
                    <x-input type="text"
                             label="Semana"
                             name="week"
                             id="week"
                             placeholder="Semana"
                             value="{{ old('week') }}"
                    />
                  </div>

                  <div class="col-md-12">
                      <div class="mb-3">
                          <label for="notes" class="form-label">
                              {{ __('Notas') }}
                          </label>

                          <textarea name="notes"
                                    id="notes"
                                    rows="5"
                                    class="form-control @error('notes') is-invalid @enderror"
                                    placeholder="Notas"
                          ></textarea>

                          @error('notes')
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
