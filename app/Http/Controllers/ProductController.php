<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Product;
use App\Models\ProductImage;

class ProductController extends Controller
{

    public function create()
    {
        $category = ProductImage::all();
        // $subcategory = Subcategory::all(); 
        return view('productscreate',compact('category'));
    } 

    public function store(Request $request)
{
    try {
        $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
            'images' => 'required|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif',
        ]);

        $product = new Product();
        $product->name = $request->name;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->save();

        $imageUrls = [];

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $filename = $image->store('posts', 'public');

                $productImage = new ProductImage();
                $productImage->product_id = $product->id;
                $productImage->url = $filename;
                $productImage->save();

                $imageUrls[] = $filename;
            }
        }
        return redirect()->route('products.create')->with('success','Product Added Successfully');;
        //return response()->json(['success' => true, 'message' => 'Prodcut Created Successfully', 'image_urls' => $imageUrls], 200);
    } catch (\Exception $e) {
        return response()->json(['error' => 'An error occurred while creating product: ' . $e->getMessage()], 400);
    }
}
public function index()
{
    $products = Product::all();
    return view('products', compact('products'));
}

public function cart()
{
    return view('cart');
}
public function addToCart($id)
{
    $product = Product::findOrFail($id);
      
    $cart = session()->get('cart', []);

    if(isset($cart[$id])) {
        $cart[$id]['quantity']++;
    } else {
        $cart[$id] = [
            "name" => $product->name,
            "quantity" => 1,
            "price" => $product->price,
        ];
    }
      
    session()->put('cart', $cart);
    return redirect()->back()->with('success', 'Product added to cart successfully!');
}

public function update(Request $request)
{
    if($request->id && $request->quantity){
        $cart = session()->get('cart');
        $cart[$request->id]["quantity"] = $request->quantity;
        session()->put('cart', $cart);
        session()->flash('success', 'Cart updated successfully');
    }
}
public function remove(Request $request)
    {
        if($request->id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Product removed successfully');
        }
    }
    public function wishlist()
{
    return view('wishlist');
}
public function addToWishlist($id)
{
    $product = Product::findOrFail($id);
      
    $wishlist = session()->get('wishlist', []);

    if(isset($wishlist[$id])) {
        $wishlist[$id]['quantity']++;
    } else {
        $wishlist[$id] = [
            "name" => $product->name,
            "quantity" => 1,
            "price" => $product->price,
        ];
    }
      
    session()->put('wishlist', $wishlist);
    return redirect()->back()->with('success', 'Product added to wishlist successfully!');
}

public function removeWishlist(Request $request)
    {
        if($request->id) {
            $wishlist = session()->get('wishlist');
            if(isset($wishlist[$request->id])) {
                unset($wishlist[$request->id]);
                session()->put('wishlist', $wishlist);
            }
            session()->flash('success', 'Product removed successfully');
            return redirect()->route('products.index');
        }
    }
   
}

   

