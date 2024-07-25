@extends('layouts.tabler')

@section('content')
  <div class="page-header d-print-none">
    <div class="container-xl">
      <div class="row g-2 align-items-center mb-3">
        <div class="col">
          <h2 class="page-title">
            {{ __('Editar Ramo') }}
          </h2>
        </div>
      </div>

      @include('partials._breadcrumbs', ['model' => $product])
    </div>
  </div>

  <div class="page-body">
    <div class="container-xl">
      <div class="row row-cards">
        <form action="{{ route('products.update', $product->uuid) }}" method="POST" enctype="multipart/form-data">
          @csrf
          @method('put')
          <div class="row">
            <div class="col-lg-4">
              <div class="card">
                <div class="card-body">
                  <h3 class="card-title">
                      {{ __('Imagen del Ramo') }}
                  </h3>

                  <img class="img-account-profile mb-2"
                      src="{{ $product->product_image ? asset('storage/' . $product->product_image) : asset('assets/img/products/default.webp') }}"
                      alt="" id="image-preview">

                  <div class="small font-italic text-muted mb-2">
                      JPG or PNG no mas largo que 2 MB
                  </div>

                  <input type="file" accept="image/*" id="image" name="product_image"
                      class="form-control @error('product_image') is-invalid @enderror"
                      onchange="previewImage();">

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
                <div class="card-body">
                  <h3 class="card-title">
                    {{ __('Detalles del Ramo') }}
                  </h3>

                  <div class="row row-cards">
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label for="name" class="form-label">
                                {{ __('Nombre') }}
                                <span class="text-danger">*</span>
                            </label>

                            <input type="text" id="name" name="name"
                                class="form-control @error('name') is-invalid @enderror"
                                placeholder="Nombre del Ramo" value="{{ old('name', $product->name) }}">

                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-6">
                      <div class="mb-3">
                        <label for="category_id" class="form-label">
                          Tipo Empaque
                          <span class="text-danger">*</span>
                        </label>

                        <select name="category_id" id="category_id"
                          class="form-select @error('category_id') is-invalid @enderror">
                          <option selected="" disabled="">Seleccione Tipo:</option>
                          @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                @if (old('category_id', $product->category_id) == $category->id) selected="selected" @endif>
                                {{ $category->name }}</option>
                          @endforeach
                        </select>

                        @error('category_id')
                          <div class="invalid-feedback">
                              {{ $message }}
                          </div>
                        @enderror
                      </div>
                    </div>

                    <div class="col-sm-6 col-md-6">
                      <div class="mb-3">
                        <label for="consecutive" class="form-label">
                            {{ __('Consecutivo') }}
                        </label>

                        <input type="text" id="consecutive" name="consecutive"
                            class="form-control @error('consecutive') is-invalid @enderror"
                            placeholder="Consecutivo"
                            value="{{ old('consecutive', $product->consecutive) }}">

                        @error('consecutive')
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
                                @if (old('lands_id', $product->lands_id) == $land->id) selected="selected" @endif>
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

                    <div class="col-sm-6 col-md-6">
                      <div class="mb-3">
                        <label for="varietie_id" class="form-label">
                          Variedad
                          <span class="text-danger">*</span>
                        </label>

                        <select name="varietie_id" id="varietie_id"
                          class="form-select @error('varietie_id') is-invalid @enderror">
                          <option selected="" disabled="">Seleccione una Variedad:</option>
                          @foreach ($varieties as $variety)
                            <option value="{{ $variety->id }}"
                                @if (old('varietie_id', $product->varietie_id) == $variety->id) selected="selected" @endif>
                                {{ $variety->name }}</option>
                          @endforeach
                        </select>

                        @error('varietie_id')
                          <div class="invalid-feedback">
                              {{ $message }}
                          </div>
                        @enderror
                      </div>
                    </div>

                    <div class="col-sm-6 col-md-6">
                      <div class="mb-3">
                        <label class="form-label" for="type_branche_id">
                            {{ __('Tipo de Ramo') }}
                            <span class="text-danger">*</span>
                        </label>

                          <select name="type_branche_id" id="type_branche_id"
                              class="form-select @error('type_branche_id') is-invalid @enderror">
                              <option selected="" disabled="">
                                  Seleccione un Tipo de Ramo:
                              </option>

                              @foreach ($type_branches as $type_branche)
                                  <option value="{{ $type_branche->id }}"
                                      @if (old('type_branche_id', $product->type_branche_id) == $type_branche->id) selected="selected" @endif>
                                      {{ $type_branche->name }}</option>
                              @endforeach
                          </select>

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

                        <select name="table_id" id="table_id"
                          class="form-select @error('table_id') is-invalid @enderror">
                          <option selected="" disabled="">Seleccione una Mesa:</option>
                          @foreach ($tables as $table)
                            <option value="{{ $table->id }}"
                                @if (old('table_id', $product->table_id) == $table->id) selected="selected" @endif>
                                {{ $table->name }}</option>
                          @endforeach
                        </select>

                        @error('table_id')
                          <div class="invalid-feedback">
                              {{ $message }}
                          </div>
                        @enderror
                      </div>
                    </div>

                    <div class="col-sm-6 col-md-6">
                      <div class="mb-3">
                        <label for="grades_id" class="form-label">
                          Grado
                          <span class="text-danger">*</span>
                        </label>

                        <select name="grades_id" id="grades_id"
                          class="form-select @error('grades_id') is-invalid @enderror">
                          <option selected="" disabled="">Seleccione un Grado:</option>
                          @foreach ($grades as $grade)
                            <option value="{{ $grade->id }}"
                                @if (old('grades_id', $product->grades_id) == $grade->id) selected="selected" @endif>
                                {{ $grade->name }}</option>
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
                        <div class="mb-3">
                            <label for="quantity" class="form-label">
                                {{ __('Cantidad de Tallos') }}
                            </label>

                            <input class="form-control" name="quantity" type="text"  value="{{ old('quantity', $product->quantity) }}"  required="true" aria-required="true" style="color: var(--tblr-secondary);background-color: var(--tblr-bg-surface-secondary); opacity: 1;"/>


                            {{-- <input type="text" id="quantity" name="quantity"
                                class="form-control"
                                min="0" value="{{ old('quantity', $product->quantity) }}"
                                placeholder="0" disabled > --}}
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-6">
                        <div class="mb-3">
                            <label for="date" class="form-label">
                                {{ __('Fecha') }}
                            </label>

                            <input type="date" id="date" name="date"
                                class="form-control @error('date') is-invalid @enderror"
                                placeholder="Fecha"
                                value="{{ old('date', $product->date) }}">

                            @error('date')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-6">
                        <div class="mb-3">
                            <label for="week" class="form-label">
                                {{ __('Semana') }}
                            </label>

                            <input type="text" id="week" name="week"
                                class="form-control @error('week') is-invalid @enderror"
                                placeholder="Semana"
                                value="{{ old('week', $product->week) }}">

                            @error('week')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="mb-3 mb-0">
                            <label for="notes" class="form-label">
                                {{ __('Notas') }}
                            </label>

                            <textarea name="notes" id="notes" rows="5" class="form-control @error('notes') is-invalid @enderror"
                                placeholder="Notas">{{ old('notes', $product->notes) }}</textarea>

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
@endpushonce
