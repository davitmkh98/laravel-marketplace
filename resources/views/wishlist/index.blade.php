@extends('layouts.marketplace')

@section('content')

<h1 class="mb-4">My Wishlist</h1>

@if($products->isEmpty())

    <div class="alert alert-info">
        Your wishlist is empty.
    </div>

@else

<table class="table table-bordered">

    <thead>
        <tr>
            <th>Image</th>
            <th>Name</th>
            <th>Price</th>
            <th>View</th>
        </tr>
    </thead>

    <tbody>

    @foreach($products as $product)

        <tr>

            <td>
                @if($product->image)
                    <img
                        src="{{ asset('storage/' . $product->image) }}"
                        width="80"
                        alt="{{ $product->name }}">
                @endif
            </td>

            <td>{{ $product->name }}</td>

            <td>${{ number_format($product->price, 2) }}</td>


<td>

    <a href="{{ route('products.show', $product) }}"
       class="btn btn-primary btn-sm">
        View
    </a>

    <form action="{{ route('wishlist.destroy', $product) }}"
          method="POST"
          style="display:inline">

        @csrf
        @method('DELETE')

        <button class="btn btn-danger btn-sm">
            Remove
        </button>

    </form>

</td>









        </tr>

    @endforeach

    </tbody>

</table>

{{ $products->links() }}

@endif

@endsection