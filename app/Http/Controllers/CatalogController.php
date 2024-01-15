<?php

namespace App\Http\Controllers;

use App\Models\Keranjang;
use App\Models\Product;
use App\Models\Toping;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('catalog.index', compact('products'));
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        $topings = Toping::all();

        return view('catalog.show', compact('product', 'topings'));
    }

    public function addToCart(Request $request, $productId)
    {
        $request->validate([
            'topping' => 'required|exists:topings,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($productId);

        $existingCart = Keranjang::where('product_id', $product->id)
            ->where('toping_id', $request->topping)
            ->first();

        if ($existingCart) {
            $existingCart->update([
                'quantity' => $existingCart->quantity + $request->quantity,
            ]);
        } else {
            Keranjang::create([
                'product_id' => $product->id,
                'toping_id' => $request->topping,
                'jumlah' => $request->quantity,
            ]);
        }

        return redirect()->route('catalog.index')->with('success', 'Product added to cart successfully');
    }
}
