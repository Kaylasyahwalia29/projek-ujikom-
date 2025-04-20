<?php

namespace App\Http\Controllers;

use Alert;
use App\Models\Detail_Transaksi;
use App\Models\keranjang;
use App\Models\method;
use App\Models\pembayaran;
use App\Models\produk;
use App\Models\Transaksi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert as FacadesAlert;

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



    public function prosesCheckout(Request $request)
    {
        $userId = Auth::id();  // Mengambil ID user yang sedang login
        $keranjangs = Keranjang::with('produk')->where('user_id', $userId)->get();

        if ($keranjangs->isEmpty()) {
            return back()->with('error', 'Keranjang kosong!');
        }

        $totalHarga = $keranjangs->sum('total_harga');

        // Pastikan id_keranjang yang digunakan adalah milik user yang sedang login
        $idKeranjang = $keranjangs->first()->id;

        // ID keranjang milik user yang sedang login

        // ✅ Simpan ke tabel pembayarans
        $pembayaran = Pembayaran::create([
            'alamat' => $request->alamat,
            'id_user' => $userId,
            'id_method' => $request->id_method ?? 1,
        ]);


        $jumlahProduk = $keranjangs->sum('jumlah');

        // ✅ Setelah pembayaran disimpan, baru simpan transaksi
        $statusAwal = ($request->id_method == 1) ? 'Belum Bayar' : 'Dikemas'; // 1 = COD, lainnya = transfer

        $transaksi = Transaksi::create([
            'nama_pengguna' => Auth::user()->name,
            'nama_produk' => 'Pesanan-' . now()->format('His'),
            'total_harga' => $totalHarga,
            'jumlah_produk' => $jumlahProduk,
            'tanggal_transaksi' => Carbon::now(),
            'id_user' => $userId,
            'id_pembayaran' => $pembayaran->id,
            'status' => $statusAwal,
        ]);


        // Simpan detail transaksi untuk setiap item di keranjang
        foreach ($keranjangs as $item) {
            Detail_Transaksi::create([
                'id_transaksi' => $transaksi->id,
                'id_produk' => $item->produk_id,
                'jumlah' => $item->jumlah
            ]);
        }

        $produk = produk::find($item->produk_id);
        if ($produk) {
            $produk->stok_produk -= $item->jumlah;
            $produk->save();
        }

        Keranjang::where('user_id', $userId)->delete();

        return redirect()->route('invoice.show', $transaksi->id)->with('success', 'Pembayaran berhasil!');
    }




    public function showInvoice($id)
    {
        $transaksi = Transaksi::with('detailTransaksi.produk', 'pembayaran.method')
            ->findOrFail($id); // Ambil data transaksi beserta detail produk dan metode pembayaran

        return view('layouts.invoice', compact('transaksi'));
    }

    public function pesananSaya()
    {
        $userId = Auth::id();

        $transaksis = Transaksi::with('pembayaran.method')
            ->where('id_user', $userId)
            ->latest()
            ->get();

        return view('pesanan-saya', compact('transaksis'));
    }
}
