<?php

namespace App\Http\Controllers;

use App\Models\informasi;
use App\Models\kategori;
use App\Models\keranjang;
use App\Models\produk;

class FrontController extends Controller
{

    public function index()
    {
        $informasi = informasi::all();
        $kategori = kategori::all();
        $produk = produk::all();
        return view('index', compact('informasi', 'kategori', 'produk'));
    }

    public function produk()
    {
        $produk = produk::all();
        return view('produk', compact('produk'));
    }

    public function about()
    {
        return view('about');
    }

    public function keranjang()
    {
        $produk = produk::all();
        $keranjang = keranjang::all();
        return view('keranjang', compact('produk', 'keranjang'));
    }

    public function pembayaran()
    {
        return view('pembayaran');
    }

    public function informasi()
    {
        $informasi = informasi::all();
        return view('informasi', compact('informasi'));
    }

    public function contact()
    {
        return view('contact');
    }

    public function kategori()
    {
        $produk = produk::all();
        $kategori = kategori::all();
        return view('produk', compact('produk', 'kategori'));
    }

    public function show($id)
    {
        $produk = produk::findorfail($id);
        return view('detailproduk', compact('produk'));
    }

}
