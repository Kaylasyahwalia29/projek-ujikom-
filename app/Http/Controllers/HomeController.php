<?php

namespace App\Http\Controllers;

use App\Models\informasi;
use App\Models\kategori;
use App\Models\produk;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = Auth::user();
        if ($users->isAdmin == 1) {
            return view('admin.dashboard');
        } else {
            $informasi = informasi::all();
            $kategori = kategori::all();
            // $produk = produk::all();
            return view('index', compact('informasi', 'kategori'));

            return view('index');
        }
        $informasi = informasi::all();
        $kategori = kategori::all();
        // $produk = produk::all();
        return view('index', compact('informasi', 'kategori'));

    }
}
