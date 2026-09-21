@extends('layouts.marketplace')

@section('content')



<h1>{{ $product->name }}</h1>

@if($product->image)
    <img
        src="{{ asset('storage/' . $product->image) }}"
        alt="{{ $product->name }}"
        width="300">
@endif

<p>
    <strong>Category:</strong>
    {{ $product->category->name }}
</p>

<p>
    <strong>Seller:</strong>
    {{ $product->user->name }}
</p>

<p>
    <strong>Price:</strong>
    ${{ number_format($product->price, 2) }}
</p>


@if($product->stock > 0)
    <form action="{{ route('cart.store', $product) }}" method="POST">
        @csrf

        <button class="btn btn-success">
            Add to Cart
        </button>
    </form>
@else
    <button class="btn btn-secondary" disabled>
        Out of Stock
    </button>
@endif
@auth

@if(auth()->user()->wishlist->contains($product))

    <form action="{{ route('wishlist.destroy', $product) }}" method="POST">
        @csrf
        @method('DELETE')

        <button class="btn btn-danger mt-2">
            💔 Remove from Wishlist
        </button>
    </form>

@else

    <form action="{{ route('wishlist.store', $product) }}" method="POST">
        @csrf

        <button class="btn btn-outline-danger mt-2">
            ❤️ Add to Wishlist
        </button>
    </form>

@endif

@endauth

<p>
    <strong>Stock:</strong>
    {{ $product->stock }}
</p>

<p>
    {{ $product->description }}
</p>


<hr>

@auth

    @if(auth()->user()->role === 'buyer')

        <h3>Write a Review</h3>

@if($product->reviews->where('user_id', auth()->id())->count() > 0)
            <div class="alert alert-success">
                ✅ You have already reviewed this product.
            </div>

        @else

            <form action="{{ route('reviews.store', $product) }}" method="POST">

                @csrf

                <div class="mb-3">
                    <label class="form-label">Rating</label>

                    <select name="rating" class="form-select">
                        @for($i = 1; $i <= 5; $i++)
                            <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Comment</label>

                    <textarea
                        name="comment"
                        class="form-control"
                        rows="4">{{ old('comment') }}</textarea>
                </div>

                <button class="btn btn-primary">
                    Submit Review
                </button>

            </form>

        @endif

    @endif

@else

    <p>
        <a href="{{ route('login') }}">Log in</a> to write a review.
    </p>

@endauth

@if($product->reviews_count)

    <p>
        ⭐ {{ $product->average_rating }}/5
        ({{ $product->reviews_count }} reviews)
    </p>

@endif

@foreach($product->reviews as $review)

    <div class="border rounded p-3 mb-3">
        <strong>{{ $review->user->name }}</strong>

        <p>⭐ {{ $review->rating }}/5</p>

        <p>{{ $review->comment }}</p>
    </div>

@endforeach






<a href="{{ route('products.index') }}" class="btn btn-secondary mt-3">
    Back to Products
</a>






@endsection