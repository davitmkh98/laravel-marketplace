

@extends('layouts.marketplace')

@section('content')

    <!-- Your existing products page -->

<div class="container mt-4">





<div class="d-flex justify-content-between align-items-center mb-4">

    <h1 class="display-5 m-0">Products</h1>

</div>



@auth
    @if(auth()->user()->role === 'seller')
        <a href="{{ route('products.create') }}" class="btn btn-primary">
            + Add Product
        </a>
    @endif
@endauth




<form method="GET" action="{{ url('/products') }}" class="row g-2 mb-4">

    <div class="col-md-4">
        <input
            type="text"
            name="search"
            class="form-control"
            placeholder="Search products..."
            value="{{ request('search') }}">
    </div>

    <div class="col-auto">
        <button type="submit" class="btn btn-primary">
            Search
        </button>
    </div>

<select name="sort" class="form-select">
    <option value="">Sort By</option>
    <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>
        Price: Low to High
    </option>
    <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>
        Price: High to Low
    </option>
</select>

</form>


<br>



    



<div class="row">
    @foreach($products as $product)

        <div class="col-md-4 mb-4">

            <div class="card h-100 shadow-sm">

@if($product->image)

    <img src="{{ asset('storage/' . $product->image) }}"
         class="card-img-top"
         alt="{{ $product->name }}"
         style="height:250px; object-fit:cover;">

@else

    <div class="d-flex justify-content-center align-items-center bg-light"
         style="height:250px;">
        <span class="text-muted">No Image</span>
    </div>

@endif

    <div class="card-body">

        <h5 class="card-title">
            {{ $product->name }}
        </h5>




@if($product->reviews_count > 0)

    <div class="mb-2">
        ⭐ {{ number_format($product->average_rating, 1) }}/5
        <small class="text-muted">
            ({{ $product->reviews_count }}
            {{ $product->reviews_count == 1 ? 'review' : 'reviews' }})
        </small>
    </div>

@else

    <div class="mb-2 text-muted">
        No reviews yet
    </div>

@endif


        

        <p class="text-muted">
            {{ $product->category->name }}
        </p>

        <p>
            <strong>Seller:</strong>
            {{ $product->user->name }}
        </p>

        <h4 class="text-success">
            ${{ number_format($product->price, 2) }}
        </h4>









@if($product->stock <= 0)

    <span class="badge bg-danger">
        Out of Stock
    </span>

@elseif($product->stock <= 3)

    <span class="badge bg-warning text-dark">
        Only {{ $product->stock }} left
    </span>

@else

    <span class="badge bg-success">
        In Stock
    </span>

@endif



<div class="mt-3 d-grid gap-2">

    <a href="{{ route('products.show', $product) }}"
       class="btn btn-info">
        View
    </a>




@if($product->stock > 0)

    <form action="{{ route('cart.store', $product) }}" method="POST">
        @csrf

        <button class="btn btn-success w-100">
            Add to Cart
        </button>
    </form>

@else

    <button class="btn btn-secondary w-100" disabled>
        Unavailable
    </button>

@endif



@auth
    @if(auth()->id() === $product->user_id)

        <a href="{{ route('products.edit', $product) }}"
           class="btn btn-warning">
            Edit
        </a>

        <form action="{{ route('products.destroy', $product) }}"
              method="POST">
            @csrf
            @method('DELETE')

            <button class="btn btn-danger w-100">
                Delete
            </button>
        </form>

    @endif
@endauth

</div>
        
    </div>

</div>

        </div>

    @endforeach
</div>








<div class="mt-4">
    {{ $products->links() }}
</div>


</div>


@endsection