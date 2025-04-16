<?php

namespace App\Http\Controllers;
use App\Models\Informasi;
use App\Models\Kategori;
use App\Models\Keranjang;
use App\Models\Produk;

class FrontController extends Controller
{
    public function index()
    {
        $informasi = Informasi::all();
        $kategori = Kategori::all();
        $produk = Produk::all();
        return view('index', compact('informasi', 'kategori', 'produk'));
    }

    public function produk()
    {
        $produk = Produk::all();
        return view('produk', compact('produk'));
    }

    public function about()
    {
        return view('about');
    }

    public function keranjang()
    {
        $produk = Produk::all();
        $keranjang = Keranjang::all();
        return view('keranjang', compact('produk', 'keranjang'));
    }

    public function pembayaran()
    {
        return view('pembayaran');
    }

    public function informasi()
    {
        $informasi = Informasi::all();
        return view('informasi', compact('informasi'));
    }

    public function contact()
    {
        return view('contact');
    }

    public function kategori()
    {
        $produk = Produk::all();
        $kategori = Kategori::all();
        return view('produk', compact('produk', 'kategori'));
    }

    public function show($id)
    {
        $produk = Produk::findOrFail($id);
        return view('detailproduk', compact('produk'));
    }
}
