<?php

namespace App\Http\Controllers;

use App\Models\Product;

class WishlistController extends Controller
{
    public function store(Product $product)
    {
        auth()->user()->wishlist()->syncWithoutDetaching($product->id);

        return back()->with('success', 'Product added to wishlist.');
    }


public function index()
{
    $products = auth()->user()->wishlist()->paginate(10);

    return view('wishlist.index', compact('products'));
}


public function destroy(Product $product)
{
    auth()->user()->wishlist()->detach($product->id);

    return back()->with('success', 'Product removed from wishlist.');
}
    
}