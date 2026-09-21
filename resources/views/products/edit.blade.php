
@extends('layouts.marketplace')
@section('content')

<h1>Edit Product</h1>
        <form method="POST" action="{{ route('products.update', $product) }}" enctype="multipart/form-data" class="mt-4">
    @csrf
    @method('PUT')

    <p>
        <label>Name:</label><br>
        <input type="text" name="name"
       value="{{ old('name', $product->name) }}"
       class="form-control">
    </p>

    <p>
        <label>Category:</label><br>
        <select name="category_id" class="form-select">
            @foreach($categories as $category)
                <option value="{{ $category->id }}"
                    {{ $product->category_id == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
    </p>

        @if($product->image)
            <p>Current Image:</p>

            <img src="{{ asset('storage/' . $product->image) }}"
                 alt="{{ $product->name }}"
                 width="120">

            <br><br>
        @endif

        <p>
            <label>New Image (optional):</label><br>
            <input type="file" name="image" class="form-control">
        </p>
    <p>
        
        <label>Description:</label><br>
        <textarea name="description"
          class="form-control">{{ old('description', $product->description) }}</textarea>
    </p>

    <p>
        <label>Price:</label><br>
        <input type="number" step="0.01" name="price"
       value="{{ old('price', $product->price) }}"
       class="form-control">
    </p>

    <p>
        <label>Stock:</label><br>
        <input type="number" name="stock"
       value="{{ old('stock', $product->stock) }}"
       class="form-control">
    </p>

    <button type="submit" class="btn btn-primary">
    Update Product
</button>
</form>
@endsection
