<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Category;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;





class ProductController extends Controller
{

public function index()
{
    $products = Product::with(['category', 'user', 'reviews'])
        ->when(request('search'), function ($query) {
            $query->where('name', 'like', '%' . request('search') . '%');
        })
        ->when(request('sort') == 'price_asc', function ($query) {
            $query->orderBy('price', 'asc');
        })
        ->when(request('sort') == 'price_desc', function ($query) {
            $query->orderBy('price', 'desc');
        })
        ->paginate(5);

    return view('products.index', compact('products'));
}





    public function edit(Product $product)
{


$this->authorize('update', $product);

    $categories = Category::all();

    return view('products.edit', compact('product', 'categories'));
}



public function show(Product $product)
{
    $inWishlist = false;

    if (auth()->check()) {
        $inWishlist = auth()->user()
            ->wishlist()
            ->where('product_id', $product->id)
            ->exists();
    }

    return view('products.show', compact('product', 'inWishlist'));
}




    public function create()
    {

if (auth()->user()->role !== 'seller') {
    abort(403);
}

        
        $categories = Category::all();

        return view('products.create', compact('categories'));
    }





public function store(Request $request)
{

if (auth()->user()->role !== 'seller') {
    abort(403);
}


    $request->validate([
        'name' => 'required|max:255',
        'category_id' => 'required|exists:categories,id',
        'description' => 'required',
        'price' => 'required|numeric',
        'stock' => 'required|integer',
        'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
    ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }
        

    Product::create([
        'user_id' => Auth::id(),
        'category_id' => $request->category_id,
        'name' => $request->name,
        'slug' => Str::slug($request->name),
        'description' => $request->description,
        'price' => $request->price,
        'stock' => $request->stock,
        'image' => $imagePath,
    ]);

    return redirect('/products');
}

public function update(Request $request, Product $product)
{


$this->authorize('update', $product);

    $request->validate([
        'name' => 'required|max:255',
        'category_id' => 'required|exists:categories,id',
        'description' => 'required',
        'price' => 'required|numeric',
        'stock' => 'required|integer',
        'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
    ]);

$imagePath = $product->image;

if ($request->hasFile('image')) {

    if ($product->image) {
        Storage::disk('public')->delete($product->image);
    }

    $imagePath = $request->file('image')->store('products', 'public');
}


    $product->update([
        'category_id' => $request->category_id,
        'name' => $request->name,
        'slug' => Str::slug($request->name),
        'description' => $request->description,
        'price' => $request->price,
        'stock' => $request->stock,
        'image' => $imagePath,
    ]);

    return redirect('/products');
}



public function destroy(Product $product)
{



    $this->authorize('delete', $product);
    if ($product->image) {
        Storage::disk('public')->delete($product->image);
    }

    $product->delete();

    return redirect('/products');
}

public function sellerProducts()
{
    if (auth()->user()->role !== 'seller') {
        abort(403);
    }

    $products = Product::where('user_id', auth()->id())
        ->latest()
        ->paginate(10);

    $totalProducts = Product::where('user_id', auth()->id())->count();

    return view('seller.products', compact('products', 'totalProducts'));
}

}
