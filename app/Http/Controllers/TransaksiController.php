<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Pengguna;
use App\Models\produk;
use App\Models\Transaksi;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    public function index()
    {
        $transaksis = DB::table('transaksis')->get();
        return view('admin.transaksi.index', compact('transaksis'));
    }

    public function create()
    {
        $penggunas = User::all();
        $barangs   = produk::all();
        return view('admin.transaksi.create', compact('penggunas', 'barangs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_pengguna' => 'required|exists:penggunas,id',
            'id_barang'   => 'required|exists:barangs,id',
            'total'       => 'required|numeric',
        ]);

        Transaksi::create([
            'id_pengguna' => $request->id_pengguna,
            'id_barang'   => $request->id_barang,
            'total'       => $request->total,
            'status'      => 'Belum Bayar', // default saat create
        ]);


        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil ditambahkan.');
    }


    public function ubahStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Belum Bayar,Dikemas,Dikirim,Selesai,Pengembalian,Dibatalkan',
        ]);

        $transaksi = Transaksi::findOrFail($id);
        $transaksi->status = $request->status;
        $transaksi->save();

        return redirect()->back()->with('success', 'Status berhasil diubah.');
    }


    public function show($id)
    {
        $transaksi = Transaksi::with(['pengguna', 'barang'])->findOrFail($id);
        return view('admin.transaksi.show', compact('transaksi'));
    }

    public function edit($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $penggunas = Pengguna::all();
        $barangs   = Barang::all();
        return view('admin.transaksi.edit', compact('transaksi', 'penggunas', 'barangs'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_pengguna' => 'required|exists:penggunas,id',
            'id_barang'   => 'required|exists:barangs,id',
            'total'       => 'required|numeric|min:0',
        ]);

        $transaksi = Transaksi::findOrFail($id);
        $transaksi->update([
            'id_pengguna' => $request->id_pengguna,
            'id_barang'   => $request->id_barang,
            'total'       => $request->total,
        ]);

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil diupdate.');
    }

    public function destroy($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->delete();

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil dihapus.');
    }
}
