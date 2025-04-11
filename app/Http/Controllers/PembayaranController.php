<?php

namespace App\Http\Controllers;

use Alert;
use App\Models\keranjang;
use App\Models\method;
use App\Models\pembayaran;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $pembayaran = pembayaran::all();
        $keranjang = keranjang::all();  
        $method = method::all();
        confirmDelete('Delete', 'Apakah Kamu Yakin?');
        return view('admin.pembayaran.index', compact('pembayaran', 'keranjang', 'method'));

    }

    public function create()
    {
        $pembayaran = pembayaran::all();
        $keranjang = keranjang::all();
        $method = method::all();
        return view('admin.pembayaran.create', compact('pembayaran', 'keranjang', 'method'));

    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'alamat' => 'required',
            'id_keranjang' => 'required',
            'id_method' => 'required',
        ]);

        $pembayaran = new pembayaran();
        $pembayaran->alamat = $request->alamat;
        $pembayaran->id_keranjang = $request->id_keranjang;
        $pembayaran->id_method = $request->id_method;

        $pembayaran->save();
        Alert::success('Success', 'Data Berhasil Disimpan')->autoClose(1000);
        return redirect()->route('pembayaran.index');

    }

    public function show(pembayaran $pembayaran)
    {
        //
    }

    public function edit(pembayaran $pembayaran)
    {
        $pembayaran = pembayaran::all();
        $keranjang = keranjang::all();
        $method = method::all();
        return view('admin.pembayaran.edit', compact('pembayaran', 'keranjang', 'method'));

    }

    public function update(Request $request, pembayaran $pembayaran)
    {
        $validated = $request->validate([
            'alamat' => 'required',
            'id_keranjang' => 'required',
            'id_method' => 'required',
        ]);

        $pembayaran = pembayaran::findOrFail($id);
        $pembayaran->alamat = $request->alamat;
        $pembayaran->id_keranjang = $request->id_keranjang;
        $pembayaran->id_method = $request->id_method;

        $pembayaran->save();
        Alert::success('Success', 'Data Berhasil Di Ubah')->autoClose(1000);
        return redirect()->route('pembayaran.index');

    }

    public function destroy(pembayaran $pembayaran)
    {
        $pembayaran = pembayaran::findOrFail($id);
        $pembayaran->delete();
        Alert::success('Success', 'Data Berhasil Di Hapus')->autoClose(1000);
        return redirect()->route('pembayaran.index');

    }
}
