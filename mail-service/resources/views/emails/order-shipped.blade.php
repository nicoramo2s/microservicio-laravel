<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>{{ $subject }}</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
</head>

<body>
    <h1>{{$subject}}</h1>
    <p>Gracias por su pedido, {{ $order['customer_name'] }}!</p>

    <h2>Detalles de la Orden:</h2>
    <ul>
        @foreach ($order['items'] as $item)
            <li>
                <strong>Producto:</strong> {{ $item['name'] }}<br>
                <strong>Descripción:</strong> {{ $item['description'] }}<br>
                <strong>Categoria:</strong> {{ $item['category'] }}<br>
                <strong>Precio:</strong> ${{ $item['price'] }}<br>
                <strong>Cantidad:</strong> {{ $item['quantity'] }}<br>
                <strong>Ingredientes:</strong> {{ implode(',', $item['ingredients']) }}<br><br>
            </li>
        @endforeach
    </ul>
    <p>{{ $contentBody }}</p>
    <p><strong>Total a pagar: </strong>${{ $order['total_price'] }}</p>
    <p><strong>Estado de la orden: </strong>{{ ucfirst($order['status']) }}</p>

    <p>Gracias por comprar nuestros productos</p>
</body>

</html>
