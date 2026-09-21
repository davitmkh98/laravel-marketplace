@extends('layouts.marketplace')

@section('content')

<div class="container mt-4">

    <h1>Seller Orders</h1>

    @forelse($orders as $order)

        <div class="card mb-4">
            <div class="card-body">

                <h5>Order #{{ $order->id }}</h5>

                <p>
                    <strong>Customer:</strong>
                    {{ $order->user->name }}
                </p>

                <p>
                    <strong>Order Status:</strong>
                    <span class="badge bg-secondary">
                        {{ $order->status }}
                    </span>
                </p>
<a href="{{ route('seller.orders.show', $order) }}"
   class="btn btn-warning">
    Edit Status
</a>



<a href="{{ route('seller.orders.show', $order) }}"
   class="btn btn-primary">
    View
</a>
                <h6>Your Products:</h6>

                @foreach($order->items as $item)

                    <div class="border rounded p-3 mb-2">

                        <strong>{{ $item->name }}</strong>

                        <div>
                            Quantity: {{ $item->quantity }}
                        </div>

                        <div>
                            Price: ${{ number_format($item->price, 2) }}
                        </div>

                        <div>
                            Subtotal:
                            ${{ number_format($item->subtotal, 2) }}
                        </div>

                    </div>

                @endforeach

            </div>
        </div>

    @empty

        <p>No orders found.</p>

    @endforelse

    {{ $orders->links() }}

</div>

@endsection