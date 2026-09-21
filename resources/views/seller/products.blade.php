@extends('layouts.marketplace')

@section('content')

<h1 class="mb-4">Seller Dashboard</h1>

<a href="{{ route('products.create') }}" class="btn btn-primary mb-3">
    + Add Product
</a>

@if($products->isEmpty())

    <div class="alert alert-info">
        You haven't created any products yet.
    </div>

@else


<div class="row mb-4">

    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h5>Total Products</h5>
                <h2>{{ $totalProducts }}</h2>
            </div>
        </div>
    </div>

</div>



<table class="table table-dark table-striped">

    <thead>
        <tr>
            <th>Name</th>
            <th>Price</th>
            <th>Stock</th>
            <th>Actions</th>
        </tr>
    </thead>

    <tbody>

    @foreach($products as $product)

        <tr>

            <td>{{ $product->name }}</td>

            <td>${{ number_format($product->price, 2) }}</td>

            <td>{{ $product->stock }}</td>

            <td>

                <a href="{{ route('products.show', $product) }}"
                   class="btn btn-info btn-sm">
                    View
                </a>

                <a href="{{ route('seller.products.edit', $product) }}"
                   class="btn btn-warning btn-sm">
                    Edit
                </a>



                <form action="{{ route('products.destroy', $product) }}"
                      method="POST"
                      style="display:inline">

                    @csrf
                    @method('DELETE')

                    <button class="btn btn-danger btn-sm"
                            onclick="return confirm('Delete this product?')">
                        Delete
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