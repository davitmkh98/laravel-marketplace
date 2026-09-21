<?php

namespace App\Http\Controllers;


use App\Models\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CartController extends Controller
{
    //


public function index()
{   
    $cart = session()->get('cart', []);
    $total = 0;

    foreach ($cart as $item) {
        $total += $item['price'] * $item['quantity'];
    }   

    return view('cart.index', compact('cart', 'total'));
}



public function store(Product $product)
{
    if ($product->stock <= 0) {
        return redirect()->back()
            ->with('error', 'This product is currently unavailable.');
    }

    $cart = session()->get('cart', []);

    $currentQuantity = $cart[$product->id]['quantity'] ?? 0;


    if ($currentQuantity >= $product->stock) {
        return redirect()->back()
            ->with('error', 'You cannot add more than the available stock.');
    }

    if (isset($cart[$product->id])) {

        $cart[$product->id]['quantity']++;

    } else {

        $cart[$product->id] = [
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'quantity' => 1,
        ];
    }

    session()->put('cart', $cart);

    return redirect()->route('cart.index');
}
public function destroy($id)
{
    $cart = session()->get('cart', []);

    unset($cart[$id]);

    session()->put('cart', $cart);

    return redirect()->route('cart.index');
}






}
