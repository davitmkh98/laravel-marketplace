@extends('layouts.marketplace')

@section('content')
<h1 class="mb-4">Order #{{ $order->id }}</h1>

<p><strong>Status:</strong> {{ $order->status }}</p>
<p><strong>Total:</strong> {{ $order->total }}</p>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Product</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Subtotal</th>
        </tr>
    </thead>
    <tbody>
        @foreach($order->items as $item)
            <tr>
                <td>{{ $item->name }}</td>
                <td>{{ $item->price }}</td>
                <td>{{ $item->quantity }}</td>
                <td>{{ $item->subtotal }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection