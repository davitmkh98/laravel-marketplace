@extends('layouts.marketplace')

@section('content')
<h1 class="mb-4">Order #{{ $order->id }}</h1>

<p><strong>Status:</strong> {{ $order->status }}</p>
<p><strong>Total:</strong> ${{ number_format($order->total, 2) }}</p>

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
                <td>${{ number_format($item->price, 2) }}</td>
                <td>{{ $item->quantity }}</td>
                <td>${{ number_format($item->subtotal, 2) }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection