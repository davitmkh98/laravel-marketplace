@extends('layouts.marketplace')

@section('content')

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif



@if($errors->has('cart'))
    <div class="alert alert-danger">{{ $errors->first('cart') }}</div>
@endif




    

    <h1>Shopping Cart</h1>

    @forelse($cart as $item)

        <div>
            <h3>{{ $item['name'] }}</h3>

            <p>Price: ${{ $item['price'] }}</p>

            <p>Quantity: {{ $item['quantity'] }}</p>
            <p>
            Subtotal:
            ${{ $item['price'] * $item['quantity'] }}
            </p>
        </div>




<form action="{{ route('cart.destroy', $item['id']) }}" method="POST">
    @csrf
    @method('DELETE')

    <button type="submit" class="btn btn-danger">
        Remove
    </button>
</form>





        <hr>

    @empty

        <p>Your cart is empty.</p>

    @endforelse

<hr>

<h3>Total: ${{ $total }}</h3>

<form action="{{ route('checkout.store') }}" method="POST" class="mt-3">
    @csrf
    <button type="submit" class="btn btn-primary">
        Place Order (Demo — No Payment)
    </button>
</form>
@endsection
