@extends('layouts.tabler')

@section('content')
    <div class="page">
        <div class="page-body">
            <div class="container-xl">
                <div class="card">
                    <div class="card-header">
                        <div>
                            <h3 class="card-title">
                                {{ __('Detallde del pedido pendiente') }}
                            </h3>
                        </div>
                        <div class="card-actions btn-actions">
                            <div class="dropdown">
                                <a href="#" class="btn-action dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <!-- Download SVG icon from http://tabler-icons.io/i/dots-vertical -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M12 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path><path d="M12 19m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path><path d="M12 5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path></svg>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end" style="">
                                    <a href="{{ route('due.edit', $order) }}" class="dropdown-item text-warning">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-pencil" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 20h4l10.5 -10.5a2.828 2.828 0 1 0 -4 -4l-10.5 10.5v4" /><path d="M13.5 6.5l4 4" /></svg>
                                        {{ __('Editar Orden') }}
                                    </a>
                                </div>
                            </div>
                            <x-action.close route="{{ route('due.index') }}" />
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row row-cards mb-3">
                            <div class="col">
                                <label for="order_date" class="form-label required">
                                    {{ __('Fecha de Orden') }}
                                </label>
                                <input type="text"
                                       id="order_date"
                                       class="form-control"
                                       value="{{ $order->order_date->format('d-m-Y') }}"
                                       disabled
                                >
                            </div>

                            <div class="col">
                                <label for="invoice_no" class="form-label required">
                                    {{ __('Factura No.') }}
                                </label>
                                <input type="text"
                                       id="invoice_no"
                                       class="form-control"
                                       value="{{ $order->invoice_no }}"
                                       disabled
                                >
                            </div>

                            <div class="col">
                                <label for="customer" class="form-label required">
                                    {{ __('Cliente') }}
                                </label>
                                <input type="text"
                                       id="customer"
                                       class="form-control"
                                       value="{{ $order->customer->name }}"
                                       disabled
                                >
                            </div>

                            <div class="col">
                                <label for="payment_type" class="form-label required">
                                    {{ __('Tipo de Pago') }}
                                </label>
                                <input type="text" id="payment_type" class="form-control" value="{{ $order->payment_type }}" disabled>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-striped table-bordered align-middle">
                                <thead class="thead-light">
                                <tr>
                                    <th scope="col" class="align-middle text-center">No.</th>
                                    <th scope="col" class="align-middle text-center">Foto</th>
                                    <th scope="col" class="align-middle text-center">Nombre del Ramo</th>
                                    <th scope="col" class="align-middle text-center">Código del Ramo</th>
                                    <th scope="col" class="align-middle text-center">Cantidad</th>
                                    <th scope="col" class="align-middle text-center">Precio</th>
                                    <th scope="col" class="align-middle text-center">Total</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($order->details as $item)
                                    <tr>
                                        <td class="align-middle text-center">
                                            {{ $loop->iteration  }}
                                        </td>
                                        <td class="align-middle text-center">
                                            <div style="max-height: 80px; max-width: 80px;">
                                                <img
                                                    class="img-fluid"
                                                    src="{{ $item->product->product_image
                                                        ? asset('storage/'.$item->product->product_image)
                                                        : asset('assets/img/products/default.webp') }}"
                                                >
                                            </div>
                                        </td>
                                        <td class="align-middle text-center">
                                            {{ $item->product->name }}
                                        </td>
                                        <td class="align-middle text-center">
                                            {{ $item->product->code }}
                                        </td>
                                        <td class="align-middle text-center">
                                            {{ $item->quantity }}
                                        </td>
                                        <td class="align-middle text-center">
                                            {{ number_format($item->unitcost, 2) }}
                                        </td>
                                        <td class="align-middle text-center">
                                            {{ number_format($item->total, 2) }}
                                        </td>
                                    </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="6" class="text-end">
                                            Monto de Pago
                                        </td>
                                        <td class="text-center">{{ number_format($order->pay, 2) }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="6" class="text-end">Pendiente</td>
                                        <td class="text-center">{{ number_format($order->due, 2) }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="6" class="text-end">Iva</td>
                                        <td class="text-center">{{ number_format($order->vat, 2) }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="6" class="text-end">Total</td>
                                        <td class="text-center">{{ number_format($order->total, 2) }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-due">
                            {{ __('Pagar Pendiente') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('partials._modal_due', $order)
@endsection
