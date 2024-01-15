<?php

namespace App\Http\Controllers;

use App\Models\Keranjang;
use App\Models\Product;
use App\Models\Toping;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = Keranjang::all();
        $sub_total = 0;

        foreach ($cartItems as $cartItem) {
            $product = Product::find($cartItem->product_id);
            $toping = Toping::find($cartItem->toping_id);

            $sub_total += $toping->harga * $cartItem->jumlah;
            $sub_total += $product->harga * $cartItem->jumlah;

            $cartItem->product_name = $product ? $product->nama_produk : 'Product not found';
            $cartItem->toping_name = $toping ? $toping->nama_toping : 'Toping not found';
        }

        return view('cart.index', compact('cartItems','sub_total'));
    }

    public function deleteCartItem($id)
    {
        $cartItem = Keranjang::find($id);

        if ($cartItem) {
            $cartItem->delete();
        }

        return redirect()->route('cart.index')->with('success', 'Item deleted successfully');
    }
}
