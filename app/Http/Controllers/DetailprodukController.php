<?php

namespace App\Http\Controllers;

use App\Models\produk;

class DetailprodukController extends Controller
{
    public function show($id)
    {
        $produk = produk::findorfail($id);
        // $kategori = kategori::all();
        return view('detailproduk', compact('produk'));

    }
}
