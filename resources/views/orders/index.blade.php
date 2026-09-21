@extends('layouts.marketplace')

@section('content')
<h1 class="mb-4">My Orders</h1>

@forelse($orders as $order)
    <div class="mb-3 p-3 border rounded">
        <div>Order #{{ $order->id }}</div>
        <div>Total: {{ $order->total }}</div>


<p>
    <strong>Status:</strong>

    @switch($order->status)

        @case('Pending')
            <span class="badge bg-warning">Pending</span>
            @break

        @case('Processing')
            <span class="badge bg-primary">Processing</span>
            @break

        @case('Shipped')
            <span class="badge bg-info">Shipped</span>
            @break

        @case('Delivered')
            <span class="badge bg-success">Delivered</span>
            @break

        @default
            <span class="badge bg-secondary">
                {{ $order->status }}
            </span>

    @endswitch
</p>



<a href="{{ route('orders.show', $order) }}"
   class="btn btn-primary">
    View
</a>




    </div>
@empty
    <p>You have no orders yet.</p>
@endforelse

{{ $orders->links() }}
@endsection