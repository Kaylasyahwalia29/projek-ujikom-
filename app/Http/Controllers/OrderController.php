<?php

namespace App\Http\Controllers;

use App\Models\Keranjang;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{

    public function showCheckout()
    {
        $cartItems = Keranjang::with('produk') // relasi ke tabel produk
            ->where('user_id', auth()->id())
            ->get();

        return view('pembayaran', compact('cartItems'));
    }

    public function placeOrder(Request $request)
    {
        // Ambil data dari form
        $user_id = auth()->user()->id; // Asumsi sudah login
        $alamat = $request->input('c_companyname');
        $method = $request->input('c_method');  // Sesuaikan dengan nama method pembayaran
        $nama_pengguna = $request->input('c_fname') . ' ' . $request->input('c_lname');
        $produk = $request->input('produk');  // Sesuaikan dengan input produk
        $total_harga = $request->input('total_harga');  // Total harga dari cart
        $tanggal_transaksi = Carbon::now();

        // Simpan data pembayaran
        $pembayaranId = DB::table('pembayarans')->insertGetId([
            'alamat' => $alamat,
            'id_keranjang' => $request->input('id_keranjang'),  // Sesuaikan
            'id_method' => $method,
            'created_at' => $tanggal_transaksi,
            'updated_at' => $tanggal_transaksi,
        ]);

        // Simpan data transaksi
        $transaksiId = DB::table('transaksis')->insertGetId([
            'nama_pengguna' => $nama_pengguna,
            'total_harga' => $total_harga,
            'tanggal_transaksi' => $tanggal_transaksi->format('Y-m-d'),
            'id_user' => $user_id,
            'id_pembayaran' => $pembayaranId,
            'created_at' => $tanggal_transaksi,
            'updated_at' => $tanggal_transaksi,
        ]);

        // Simpan detail produk ke dalam transaksi
        foreach ($produk as $prod) {
            DB::table('detail__transaksis')->insert([
                'id_transaksi' => $transaksiId,
                'id_produk' => $prod['id_produk'],  // Sesuaikan dengan ID produk
                'created_at' => $tanggal_transaksi,
                'updated_at' => $tanggal_transaksi,
            ]);
        }

        // Redirect ke halaman terima kasih atau order berhasil
        return redirect()->route('order.success');  // Pastikan punya route 'order.success'
    }
}
