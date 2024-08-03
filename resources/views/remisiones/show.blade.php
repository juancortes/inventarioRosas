@extends('layouts.tabler')

@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center mb-3">
                <div class="col">
                    <h2 class="page-title">
                        {{ 'Remisiones' }}
                    </h2>
                </div>
            </div>

            @include('partials._breadcrumbs')
        </div>
    </div>

    <div class="page-body">
        <div class="container-xl">
            <div class="row row-cards">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="card-title">
                                    {{ __('Soporte') }}
                                </h3>

                                <img style="width: 90px;" id="image-preview"
                                    src="{{ $remisiones->support ? asset('storage/' . $remisiones->support) : asset('assets/img/remisiones/default.webp') }}"
                                    alt="" class="img-account-profile mb-2">
                            </div>
                        </div>
                    </div>
                   

                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    {{ __('Detalles de la remisiwonw') }}
                                </h3>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered card-table table-vcenter text-nowrap datatable">
                                    <tbody>
                                        <tr>
                                            <td>Fecha</td>
                                            <td>{{ $remisiones->date }}</td>
                                        </tr>
                                        <tr>
                                            <td>Finca</td>
                                            <td>
                                                <a href="#"
                                                    class="badge bg-blue-lt">
                                                    {{ $remisiones->lands_id }}
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><span class="text-secondary">Variedad</span></td>
                                            <td>{{ $remisiones->variety }}</td>
                                        </tr>
                                        <tr>
                                            <td>Cantidad de Tallos</td>
                                            <td>{{ $remisiones->quantity_stems }}</td>
                                        </tr>
                                        <tr>
                                            <td>Observaciones</td>
                                            <td>{{ $remisiones->observations }}</td>
                                        </tr>
                                        
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer text-end">
                                <a class="btn btn-info" href="{{ url()->previous() }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-left"
                                        width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                        stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M5 12l14 0" />
                                        <path d="M5 12l6 6" />
                                        <path d="M5 12l6 -6" />
                                    </svg>
                                    {{ __('Volver') }}
                                </a>
                                <a class="btn btn-warning" href="{{ route('remisiones.edit', $remisiones->id) }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-pencil"
                                        width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                        stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M4 20h4l10.5 -10.5a2.828 2.828 0 1 0 -4 -4l-10.5 10.5v4" />
                                        <path d="M13.5 6.5l4 4" />
                                    </svg>
                                    {{ __('Editar') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
