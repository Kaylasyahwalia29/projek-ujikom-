<?php

namespace App\Http\Controllers;

use Alert;
use App\Models\Keranjang;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KeranjangController extends Controller
{
    public function index()
    {
        $keranjang = Keranjang::with('produk')->get();
        confirmDelete('Delete', 'Apakah Kamu Yakin?');
        return view('admin.keranjang.index', compact('keranjang'));
    }

    public function create()
    {
        $produk = Produk::all();
        return view('admin.keranjang.create', compact('produk'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'jumlah'    => 'required|min:1',
            'total'     => 'required',
            'produk_id' => 'required|exists:produks,id',
        ]);

        $keranjang              = new Keranjang();
        $keranjang->produk_id   = $request->produk_id;
        $keranjang->jumlah      = $request->jumlah;
        $keranjang->total_harga = $request->total;
        $keranjang->user_id     = Auth::id(); // <-- tambahkan ini!
        $keranjang->save();

        Alert::success('Success', 'Data Berhasil Disimpan')->autoClose(1000);
        return view('admin.keranjang.index', compact('keranjang'));
    }

    public function edit($id)
    {
        $keranjang = Keranjang::findOrFail($id);
        $produk    = Produk::all();
        return view('admin.keranjang.edit', compact('keranjang', 'produk'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name_produk' => 'required|string|max:255',
            'jumlah'      => 'required|integer',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'total'       => 'required|numeric',
        ]);

        $keranjang = Keranjang::findOrFail($id);

        // Handle Image
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images/produk'), $imageName);
            $keranjang->image = $imageName;
        }

        $keranjang->update([
            'name_produk' => $request->name_produk,
            'jumlah'      => $request->jumlah,
            'total'       => $request->total,
            'image'       => $keranjang->image,
        ]);

        return redirect()->route('keranjang.index')->with('success', 'Data keranjang berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $keranjang = Keranjang::findOrFail($id);
        $keranjang->delete();

        Alert::success('Success', 'Data Berhasil Dihapus')->autoClose(1000);
        return redirect()->route('keranjang.index');
    }


    public function userIndex()
    {
        $userId = Auth::id();
        $keranjang = Keranjang::with('produk')->where('user_id', $userId)->get();
        return view('keranjang', compact('keranjang'));
    }

    public function updateQty(Request $request, $id)
    {
        $request->validate([
            'jumlah' => 'required|integer|min:1',
        ]);

        $keranjang = Keranjang::findOrFail($id);
        $keranjang->jumlah = $request->jumlah;
        $keranjang->total_harga = $keranjang->produk->harga_produk * $request->jumlah;
        $keranjang->save();

        return response()->json(['success' => true]);
    }



    public function add(Request $request)
    {
        // Validasi input
        $request->validate([
            'produk_id' => 'required|exists:produks,id',
            'jumlah' => 'required|integer|min:1',
        ]);


        // Ambil data produk untuk hitung total harga
        $produk = Produk::findOrFail($request->produk_id);
        $totalHarga = $produk->harga_produk * $request->jumlah;

        if ($request->jumlah > $produk->stok_produk) {
            return response()->json([
                'success' => false,
                'message' => 'Jumlah melebihi stok tersedia (' . $produk->stok_produk . ')',
            ]);
        }
        // Cek apakah produk sudah ada di keranjang
        $keranjang = Keranjang::where('produk_id', $request->produk_id)
            ->where('user_id', auth()->id())
            ->first();

        if ($keranjang) {
            // Jika produk sudah ada, tambahkan jumlahnya dan hitung ulang total harga
            $keranjang->jumlah += $request->jumlah;
            $keranjang->total_harga = $keranjang->produk->harga_produk * $keranjang->jumlah;
            $keranjang->save();
        } else {
            // Jika produk belum ada, simpan produk baru ke keranjang
            Keranjang::create([
                'produk_id'   => $request->produk_id,
                'jumlah'      => $request->jumlah,
                'user_id'     => auth()->id(),
                'total_harga' => $totalHarga, // Menggunakan total harga yang sudah dihitung
            ]);
        }

        // Hitung jumlah item di keranjang
        $cartCount = Keranjang::where('user_id', auth()->id())->count();

        // Simpan jumlah keranjang ke session
        session(['cart_count' => $cartCount]);

        return response()->json([
            'success'    => true,
            'cart_count' => $cartCount,
        ]);
    }


    public function updateKeranjang(Request $request, $id)
    {
        $request->validate(['jumlah' => 'required|integer|min:1']);

        $keranjang = Keranjang::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $keranjang->jumlah = $request->jumlah;
        $keranjang->total_harga = $keranjang->produk->harga_produk * $request->jumlah;
        $keranjang->save();

        return response()->json(['success' => true]);
    }


    public function destroyKeranjang($id)
    {
        $keranjang = Keranjang::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $keranjang->delete();

        // update cart_count
        $cartCount = Keranjang::where('user_id', auth()->id())->count();
        session(['cart_count' => $cartCount]);

        return response()->json(['success' => true]);
    }
}
