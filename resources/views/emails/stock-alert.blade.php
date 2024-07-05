<!DOCTYPE html>
<html>
<head>
    <title>{{ __('Alerta de existencia') }}</title>
</head>
<body>
    <p>{{ 'The following products are gonna out of stock: ' }}</p>
    @foreach ($listProducts as $product)
        <p>{{ __('Nombre del Ramo: ' . $product->name ) }}<p>
        <p>{{ __('Existencia actual: ' . $product->quantity ) }}<p>
        <p>{{ __('Alerta si está debajo: ' . $product->quantity_alert ) }}<p>
        <hr>
    @endforeach

</body>
</html>