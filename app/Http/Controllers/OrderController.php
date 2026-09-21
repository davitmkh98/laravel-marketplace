<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class OrderController extends Controller
{   

    public function store(Request $request)
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')
                ->with('error', 'Your cart is empty.');
        }

        $user = auth()->user();
        $total = 0;

        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        DB::transaction(function () use ($cart, $user, $total) {
            $order = Order::create([
                'user_id' => $user->id,
                'total' => $total,
                'status' => 'pending',
            ]);

            foreach ($cart as $item) {
                $product = Product::findOrFail($item['id']);

                if ($product->stock < $item['quantity']) {
                    throw ValidationException::withMessages([
                        'cart' => "Not enough stock for {$product->name}.",
                    ]);
                }

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'name' => $item['name'],
                    'price' => $item['price'],
                    'quantity' => $item['quantity'],
                    'subtotal' => $item['price'] * $item['quantity'],
                ]);

                $product->decrement('stock', $item['quantity']);
            }
        });

        session()->forget('cart');

        return redirect()
                ->route('orders.index')
                ->with('success', 'Order created successfully.');
    }





public function index()
{
    if (auth()->user()->role !== 'buyer') {
        abort(403);
    }

    $orders = auth()->user()
        ->orders()
        ->latest()
        ->paginate(10);

    return view('orders.index', compact('orders'));
}

public function show(Order $order)
{
    $this->authorize('view', $order);

    $order->load('items.product', 'user');

    return view('orders.show', compact('order'));
}





public function update(Request $request, Order $order)
{
    if (auth()->user()->role !== 'seller') {
        abort(403);
    }

    $allowed = $order->items()
        ->whereHas('product', function ($query) {
            $query->where('user_id', auth()->id());
        })
        ->exists();

    if (!$allowed) {
        abort(403);
    }

    $request->validate([
    'status' => 'required|in:pending,processing,shipped,delivered,cancelled',
]);

    $order->update([
        'status' => $request->status,
    ]);

        return redirect()
    ->route('seller.orders.show', $order)
    ->with('success', 'Order status updated successfully.');
}
    

public function sellerOrders()
{
    if (auth()->user()->role !== 'seller') {
        abort(403);
    }

    $sellerId = auth()->id();

    $orders = Order::whereHas('items.product', function ($query) use ($sellerId) {
        $query->where('user_id', $sellerId);
    })
    ->with(['items' => function ($query) use ($sellerId) {
        $query->whereHas('product', function ($query) use ($sellerId) {
            $query->where('user_id', $sellerId);
        });
    }])
    ->latest()
    ->paginate(10);

    return view('seller.orders', compact('orders'));
}



public function sellerShow(Order $order)
{
    if (auth()->user()->role !== 'seller') {
        abort(403);
    }

    $items = $order->items()
        ->whereHas('product', function ($query) {
            $query->where('user_id', auth()->id());
        })
        ->get();

    if ($items->isEmpty()) {
        abort(403);
    }

    $order->load('user');

    return view('seller.orders.show', compact('order', 'items'));
}
    
}