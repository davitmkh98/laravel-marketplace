@extends('layouts.marketplace')

@section('content')
<div class="container">
    <h1>Order #{{ $order->id }}</h1>

    <p>
        <strong>Customer:</strong>
        {{ $order->user->name }}
    </p>

    <p>
        <strong>Order Date:</strong>
        {{ $order->created_at->format('Y-m-d H:i') }}
    </p>

    <p>
        <strong>Status:</strong>
        {{ ucfirst($order->status) }}
    </p>

    <hr>

    <h3>Products</h3>

    <table class="table">
        <thead>
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Subtotal</th>
            </tr>
        </thead>

        <tbody>
            @foreach($items as $item)
                <tr>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>${{ number_format($item->price, 2) }}</td>
                    <td>
                        ${{ number_format($item->price * $item->quantity, 2) }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

<h4>
    Total: ${{ number_format($order->total, 2) }}
</h4>



    <hr>

    <h3>Update Status</h3>

            <form action="{{ route('seller.orders.update', $order) }}" method="POST">
        @csrf
        @method('PUT')

        <select name="status" class="form-select">
            <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>
                Pending
            </option>

            <option value="processing" {{ $order->status === 'processing' ? 'selected' : '' }}>
                Processing
            </option>

            <option value="shipped" {{ $order->status === 'shipped' ? 'selected' : '' }}>
                Shipped
            </option>

            <option value="delivered" {{ $order->status === 'delivered' ? 'selected' : '' }}>
                Delivered
            </option>

            <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>
                Cancelled
            </option>
        </select>

        <button type="submit" class="btn btn-primary mt-2">
            Update Status
        </button>
    </form>

    <a href="{{ route('seller.orders') }}" class="btn btn-secondary mt-3">
        Back to Orders
    </a>
</div>

@endsection