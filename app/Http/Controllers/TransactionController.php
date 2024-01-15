<?php

namespace App\Http\Controllers;

use App\Models\DetailTransaksi;
use App\Models\Keranjang;
use App\Models\Product;
use App\Models\Toping;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function showTransactionForm()
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

        return view('transaction.form', compact('cartItems', 'sub_total'));
    }

    public function processTransaction(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'no_hp' => 'required',
            'sub_total' => 'required|numeric',
        ]);

        $transaksi = Transaksi::create([
            'nama_pembeli' => $request->nama,
            'alamat_pembeli' => $request->alamat,
            'no_telepon' => $request->no_hp,
            'ongkir' => 10000,
            'total_harga' => $request->sub_total + 10000,
        ]);


        $cartItems = Keranjang::all();
        foreach ($cartItems as $cartItem) {
            $sub_total = 0;
            $product = Product::find($cartItem->product_id);
            $toping = Toping::find($cartItem->toping_id);

            $sub_total += $toping->harga * $cartItem->jumlah;
            $sub_total += $product->harga * $cartItem->jumlah;
            DetailTransaksi::create([
                'transaksi_id' => $transaksi->id,
                'produk_id' => $cartItem->product_id,
                'toping_id' => $cartItem->toping_id,
                'jumlah' => $cartItem->jumlah,
                'sub_total_harga' => $sub_total,
            ]);
        }

        Keranjang::truncate();

        return redirect()->route('catalog.index')->with('success', 'Transaction successful!');
    }
}
