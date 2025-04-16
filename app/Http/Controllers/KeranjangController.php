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
}
