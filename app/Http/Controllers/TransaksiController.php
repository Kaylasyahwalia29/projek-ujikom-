<?php
namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Pengguna;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function index()
    {
        $transaksis = Transaksi::with(['pengguna', 'barang'])->get();
        confirmDelete('Delete', 'Apakah Kamu Yakin?');
        return view('admin.transaksi.index', compact('transaksis'));
    }

    public function create()
    {
        $penggunas = Pengguna::all();
        $barangs   = Barang::all();
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
        ]);

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil ditambahkan.');
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
