@extends('layouts.tabler')

@section('content')
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center mb-3">
            <div class="col">
                <h2 class="page-title">
                    {{ __('Editar Usuario') }}
                </h2>
            </div>
        </div>

        @include('partials._breadcrumbs', ['model' => $user])
    </div>
</div>

<div class="page-body">
    <div class="container-xl">
        <div class="row row-cards">

            <div class="col-lg-4">
                <div class="row row-cards">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="card-title">
                                    {{ __('Imagen del Usuario') }}
                                </h3>

                                <img class="img-account-profile rounded-circle mb-2" src="{{ $user->photo ? asset('storage/profile/'.$user->photo) : asset('assets/img/demo/user-placeholder.svg') }}" alt="" id="image-preview" />

                                <div class="small font-italic text-muted mb-2">JPG or PNG no mas largo que 1 MB</div>

                                <input class="form-control form-control-solid mb-2 @error('photo') is-invalid @enderror" type="file"  id="image" name="photo" accept="image/*" onchange="previewImage();">

                                @error('photo')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="row row-cards">

                    <div class="col-12">
                        <form action="{{ route('users.update', $user) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('put')

                            <div class="card">
                                <div class="card-body">
                                    <h3 class="card-title">
                                        {{ __('Detalles del Usuario') }}
                                    </h3>
                                    <div class="row row-cards">
                                        <div class="col-md-12">
                                            <x-input name="name" :value="old('name', $user->name)" required="true"/>

                                            <x-input name="email" :value="old('name', $user->email)" label="Email" required="true"/>
                                            
                                            <label class="small mb-1" for="role_id">
                                                {{ __('Role') }}
                                                <span class="text-danger">*</span>
                                            </label>

                                            <select class="form-select form-control-solid @error('role_id') is-invalid @enderror" id="role_id" name="role_id">
                                                <option selected="" disabled="">
                                                    Seleccione un Role:
                                                </option>

                                                @foreach ($roles as $role)
                                                    <option value="{{ $role->id }}" 
                                                    @if ($role->id == $user->role_id) selected="selected" @endif>
                                                        {{ $role->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer text-end">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Guardar') }}
                                    </button>

                                    <a class="btn btn-outline-warning" href="{{ route('users.index') }}">
                                        {{ __('Cancelar') }}
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="col-12">
                        <form action="{{ route('users.updatePassword', $user) }}" method="POST">
                            @csrf
                            @method('put')

                            <div class="card">
                                <div class="card-body">
                                    <h3 class="card-title">
                                        {{ __('Change Password') }}
                                    </h3>

                                    <div class="row row-cards">
                                        <div class="col-sm-6 col-md-6">
                                            <x-input type="password" name="password"/>
                                        </div>

                                        <div class="col-sm-6 col-md-6">
                                            <x-input type="password" name="password_confirmation" label="Password Confirmation"/>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-footer text-end">
                                    {{--- onclick="return confirm('Do you want to change the password?')" ---}}
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Save') }}
                                    </button>

                                    <a class="btn btn-outline-warning" href="{{ route('users.index') }}">
                                        {{ __('Cancel') }}
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@pushonce('page-scripts')
<script src="{{ asset('assets/js/img-preview.js') }}"></script>
@endpushonce
