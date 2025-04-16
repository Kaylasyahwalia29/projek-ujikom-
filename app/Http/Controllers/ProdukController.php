<?php
namespace App\Http\Controllers;

use Alert;
use App\Models\kategori;
use App\Models\produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{

    
    public function index()
    {
        $produk   = produk::all();
        $kategori = kategori::all();
        confirmDelete('Delete', 'Apakah Kamu Yakin?');
        return view('admin.produk.index', compact('produk', 'kategori'));

    }

    public function create()
    {
        $produk   = produk::all();
        $kategori = kategori::all();
        return view('admin.produk.create', compact('kategori', 'produk'));

    }

    public function store(Request $request)
    {
        // $request->validate([
        //     'name_produk'  => 'required|string|max:255',
        //     // 'id_kategori' => 'required|exists:kategoris,id',
        //     'harga_produk' => 'required|numeric',
        //     'stok_produk'  => 'required|numeric',
        //     'image_produk' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        //     'desc_produk'  => 'nullable|string',
        // ]);

        // $imageName = null;
        // if ($request->hasFile('image_produk')) {
        //     $image     = $request->file('image_produk');
        //     $imageName = time() . '.' . $image->getClientOriginalExtension();
        //     $image->move(public_path('images/produk'), $imageName);
        // }

        // Produk::create([
        //     'name_produk'  => $request->name_produk,
        //     'id_kategori'  => $request->id_kategori,
        //     'harga_produk' => $request->harga_produk,
        //     'stok_produk'  => $request->stok_produk,
        //     'image_produk' => $imageName,
        //     'desc_produk'  => $request->desc_produk,
        // ]);

        $produk               = new produk();
        $produk->name_produk  = $request->name_produk;
        $produk->id_kategori  = $request->id_kategori;
        $produk->harga_produk = $request->harga_produk;
        $produk->stok_produk  = $request->stok_produk;
        $produk->desc_produk  = $request->desc_produk;

        // Upload img
        if ($request->hasFile('image_produk')) {
            $img  = $request->file('image_produk');
            $name = rand(1000, 9999) . $img->getClientOriginalName();
            $img->move('images/produk/', $name);
            $produk->image_produk = $name;
        }

        $produk->save();

        return redirect()->route('produk.index')->with('success', 'Produk berhasil ditambahkan!');
    }

    public function show($id)
    {
        $produk = produk::findOrFail($id);
        return view('produk', compact('produk'));
    }

    public function edit($id)
    {
        $produk   = produk::findOrFail($id);
        $kategori = kategori::all();
        return view('admin.produk.edit', compact('produk', 'kategori'));

    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name_produk'  => 'required',
            'desc_produk'  => 'required',
            'harga_produk' => 'required',
            'stok_produk'  => 'required',
            'id_kategori'  => 'required',
        ]);

        $produk               = produk::findOrFail($id);
        $produk->name_produk  = $request->name_produk;
        $produk->desc_produk  = $request->desc_produk;
        $produk->harga_produk = $request->harga_produk;
        $produk->stok_produk  = $request->stok_produk;
        $produk->id_kategori  = $request->id_kategori;

        if ($request->hasFile('image_produk')) {
            $produk->deleteImage(); // untuk hapus gambar sebelum diganti gambar baru
            $img  = $request->file('image_produk');
            $name = rand(1000, 9999) . $img->getClientOriginalName();
            $img->move('images/produk/', $name);
            $produk->image_produk = $name;
        }

        $produk->save();
        Alert::success('Success', 'Data Berhasil Diubah')->autoClose(1000);
        return redirect()->route('produk.index');

    }

    public function destroy($id)
    {
        $produk = produk::findOrFail($id);
        $produk->delete();
        Alert::success('Success', 'Data Berhasil Di Hapus')->autoClose(1000);
        return redirect()->route('produk.index');

    }
}
