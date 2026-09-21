@extends('layouts.marketplace')
@section('content')

<h1>Create Product</h1>

<form method="POST" action="/products" enctype="multipart/form-data">
    @csrf

    <p>
        <label>Name:</label><br>
        <input type="text" name="name">
    </p>

    <p>
        <label>Category:</label><br>
        <select name="category_id">
            @foreach($categories as $category)
                <option value="{{ $category->id }}">
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
    </p>

    <p>
        <label>Description:</label><br>
        <textarea name="description"></textarea>
    </p>

    <p>
        <label>Price:</label><br>
        <input type="number" step="0.01" name="price">
    </p>

    <p>
        <label>Stock:</label><br>
        <input type="number" name="stock">
    </p>
<p>
    <label>Product Image:</label><br>
    <input type="file" name="image">
</p>
    <button type="submit">Save Product</button>

</form>
@endsection
