<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\OrderItem;



class ReviewController extends Controller
{


public function store(Request $request, Product $product)
{

if (auth()->user()->role !== 'buyer') {
    abort(403);
}
    
    $purchased = OrderItem::where('product_id', $product->id)
        ->whereHas('order', function ($query) {
            $query->where('user_id', auth()->id());
        })
        ->exists();

    if (!$purchased) {
        abort(403);
    }


$alreadyReviewed = $product->reviews()
    ->where('user_id', auth()->id())
    ->exists();

if ($alreadyReviewed) {
    return back()->with('error', 'You have already reviewed this product.');
}


    $validated = $request->validate([
        'rating' => 'required|integer|min:1|max:5',
        'comment' => 'required|string|max:1000',
    ]);

    $product->reviews()->create([
        'user_id' => auth()->id(),
        'rating' => $validated['rating'],
        'comment' => $validated['comment'],
    ]);

    return back()->with('success', 'Review added successfully.');
}

    
}