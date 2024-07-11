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
                            Categoria del Ramo
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
                                  Seleccione una categoria:
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
                      <div class="mb-3">
                        <label class="form-label" for="unit_id">
                          {{ __('Unidades') }}
                          <span class="text-danger">*</span>
                        </label>

                        @if ($units->count() === 1)
                          <select name="category_id" id="category_id"
                                class="form-select @error('category_id') is-invalid @enderror"
                                readonly
                            >
                            @foreach ($units as $unit)
                                <option value="{{ $unit->id }}" selected>
                                    {{ $unit->name }}
                                </option>
                            @endforeach
                          </select>
                        @else
                          <select name="unit_id" id="unit_id"
                              class="form-select @error('unit_id') is-invalid @enderror"
                            >
                              <option selected="" disabled="">
                                  Seleccione una unidad:
                              </option>

                              @foreach ($units as $unit)
                                  <option value="{{ $unit->id }}" @if(old('unit_id') == $unit->id) selected="selected" @endif>{{ $unit->name }}</option>
                              @endforeach
                          </select>
                        @endif

                        @error('unit_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                      </div>
                    </div>

                    <div class="col-sm-6 col-md-6">
                      <x-input type="number"
                               label="Precio de Compra"
                               name="buying_price"
                               id="buying_price"
                               placeholder="0"
                               value="{{ old('buying_price') }}"
                      />
                    </div>

                    <div class="col-sm-6 col-md-6">
                      <x-input type="number"
                               label="Precio de Venta"
                               name="selling_price"
                               id="selling_price"
                               placeholder="0"
                               value="{{ old('selling_price') }}"
                      />
                    </div>

                    <div class="col-sm-6 col-md-6">
                      <x-input type="number"
                               label="Cantidad"
                               name="quantity"
                               id="quantity"
                               placeholder="0"
                               value="{{ old('quantity') }}"
                      />
                    </div>

                    <div class="col-sm-6 col-md-6">
                      <x-input type="number"
                               label="Alerta de Cantidad"
                               name="quantity_alert"
                               id="quantity_alert"
                               placeholder="0"
                               value="{{ old('quantity_alert') }}"
                      />
                    </div>

                    <div class="col-sm-6 col-md-6">
                      <x-input type="number"
                               label="Impuesto"
                               name="tax"
                               id="tax"
                               placeholder="0"
                               value="{{ old('tax') }}"
                      />
                    </div>

                    <div class="col-sm-6 col-md-6">
                      <div class="mb-3">
                        <label class="form-label" for="tax_type">
                          {{ __('grado') }}
                        </label>

                        <select name="tax_type" id="tax_type"
                            class="form-select @error('tax_type') is-invalid @enderror"
                            >
                          @foreach(\App\Enums\Grades::cases() as $Grades)
                            <option value="{{ $Grades->value }}" @selected(old('Grades') == $Grades->value)>
                                {{ $Grades->label() }}
                            </option>
                          @endforeach
                        </select>

                        @error('tax_type')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                      </div>
                    </div>

                    <div class="col-sm-6 col-md-6">
                      <x-input type="text"
                               label="Tipo de Ramo"
                               name="type_branche"
                               id="type_branche"
                               placeholder="Tipo de Ramo"
                               value="{{ old('type_branche') }}"
                      />
                    </div>

                    <div class="col-sm-6 col-md-6">
                      <x-input type="text"
                               label="Tallos por Ramo"
                               name="branch_stem"
                               id="branch_stem"
                               placeholder="Tallos por Ramo"
                               value="{{ old('branch_stem') }}"
                      />
                    </div>

                    <div class="col-sm-6 col-md-6">
                      <x-input type="text"
                               label="Tabla"
                               name="table"
                               id="table"
                               placeholder="Tallos por Ramo"
                               value="{{ old('table') }}"
                      />
                    </div>

                    <div class="col-sm-6 col-md-6">
                      <div class="mb-3">
                        <label for="variety_id" class="form-label">
                            Variedad
                            <span class="text-danger">*</span>
                        </label>

                        @if ($varieties->count() === 1)
                          <select name="variety_id" id="variety_id"
                              class="form-select @error('variety_id') is-invalid @enderror"
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
                          <select name="variety_id" id="variety_id"
                              class="form-select @error('variety_id') is-invalid @enderror"
                              >
                              <option selected="" >
                                  Seleccione una variedad:
                              </option>

                              @foreach ($varieties as $variety)
                                  <option value="{{ $variety->id }}" @if(old('variety_id') == $variety->id) selected="selected" @endif>
                                      {{ $variety->name }}
                                  </option>
                              @endforeach
                          </select>
                        @endif

                        @error('variety_id')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                        @enderror
                      </div>
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
