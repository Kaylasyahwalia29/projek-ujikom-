<?php
namespace App\Http\Controllers;

use Alert;
use App\Models\kategori;
use App\Models\produk;
use Illuminate\Http\Request;

class KategoriController extends Controller
{

    public function index()
    {
        $kategori = kategori::all();
        $produk   = produk::all();
        confirmDelete('Delete', 'Apakah Kamu Yakin?');
        // return view('user.kategori.index', compact('kategori'));
        return view('admin.kategori.index', compact('kategori'));
    }

    public function create()
    {
        return view('admin.kategori.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name_kategori'  => 'required',
            'image_kategori' => 'required|max:4000',
        ]);

        $kategori                = new kategori();
        $kategori->name_kategori = $request->name_kategori;

// Upload img
        if ($request->hasFile('image_kategori')) {
            $img  = $request->file('image_kategori');
            $name = rand(1000, 9999) . $img->getClientOriginalName();
            $img->move('images/kategori/', $name);
            $kategori->image_kategori = $name;
        }

        $kategori->save();
        Alert::success('Success', 'Data Berhasil Disimpan')->autoClose(1000);
        return redirect()->route('kategori.index');

    }

    public function show($id)
{
    $kategori = Kategori::findOrFail($id);
    $produk = Produk::where('kategori_id', $id)->get();

    return view('detail_kategori', compact('kategori', 'produk'));
}


    // public function showKategoriToUser($id)
    // {
    //     // Ambil kategori dan produk terkait dengan relasi
    //     $kategori = Kategori::with('produk')->findOrFail($id);

    //     // Kirim data kategori ke view
    //     return view('user.kategori.detail', compact('kategori'));
    // }

    public function edit($id)
    {
        $kategori = kategori::findOrFail($id);
        return view('admin.kategori.edit', compact('kategori'));

    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name_kategori' => 'required|max:50',
            // 'image_kategori' => 'required|max:4000|mimes:jpeg,png,jpg,gif,svg',
        ]);

        $kategori                = kategori::findOrFail($id);
        $kategori->name_kategori = $request->name_kategori;

        if ($request->hasFile('image_kategori')) {
            $kategori->deleteImage(); // untuk hapus gambar sebelum diganti gambar baru
            $img  = $request->file('image_kategori');
            $name = rand(1000, 9999) . $img->getClientOriginalName();
            $img->move('images/kategori/', $name);
            $kategori->image_kategori = $name;

        }

        $kategori->save();
        Alert::success('Success', 'Data Berhasil Diubah')->autoClose(1000);
        return redirect()->route('kategori.index');

    }

    public function destroy($id)
    {
        $kategori = kategori::findOrFail($id);
        $kategori->delete();
        Alert::success('Success', 'Data Berhasil Di Hapus')->autoClose(1000);
        return redirect()->route('kategori.index');

    }
}
