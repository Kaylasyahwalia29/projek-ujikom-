<?php
namespace App\Http\Controllers;

use App\Models\Detail_Transaksi;
use Illuminate\Http\Request;

class DetailTransaksiController extends Controller
{
    /**
     * Menampilkan semua detail transaksi.
     */
    public function index()
    {
        $detailTransaksi = Detail_Transaksi::with(['transaksi', 'produk'])->get();
        return response()->json($detailTransaksi);
    }

    /**
     * Menyimpan data detail transaksi baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_transaksi' => 'required|exists:transaksis,id',
            'id_produk'    => 'required|exists:produks,id',
        ]);

        $detailTransaksi = Detail_Transaksi::create([
            'id_transaksi' => $request->id_transaksi,
            'id_produk'    => $request->id_produk,
        ]);

        return response()->json([
            'message' => 'Detail transaksi berhasil ditambahkan',
            'data'    => $detailTransaksi,
        ], 201);
    }

    /**
     * Menampilkan satu detail transaksi berdasarkan ID.
     */
    public function show($id)
    {
        $detailTransaksi = Detail_Transaksi::with(['transaksi', 'produk'])->find($id);

        if (! $detailTransaksi) {
            return response()->json(['message' => 'Detail transaksi tidak ditemukan'], 404);
        }

        return response()->json($detailTransaksi);
    }

    /**
     * Mengupdate data detail transaksi.
     */
    public function update(Request $request, $id)
    {
        $detailTransaksi = Detail_Transaksi::find($id);

        if (! $detailTransaksi) {
            return response()->json(['message' => 'Detail transaksi tidak ditemukan'], 404);
        }

        $request->validate([
            'id_transaksi' => 'exists:transaksis,id',
            'id_produk'    => 'exists:produks,id',
        ]);

        $detailTransaksi->update([
            'id_transaksi' => $request->id_transaksi ?? $detailTransaksi->id_transaksi,
            'id_produk'    => $request->id_produk ?? $detailTransaksi->id_produk,
        ]);

        return response()->json([
            'message' => 'Detail transaksi berhasil diperbarui',
            'data'    => $detailTransaksi,
        ]);
    }

    /**
     * Menghapus detail transaksi.
     */
    public function destroy($id)
    {
        $detailTransaksi = Detail_Transaksi::find($id);

        if (! $detailTransaksi) {
            return response()->json(['message' => 'Detail transaksi tidak ditemukan'], 404);
        }

        $detailTransaksi->delete();

        return response()->json(['message' => 'Detail transaksi berhasil dihapus']);
    }
}
