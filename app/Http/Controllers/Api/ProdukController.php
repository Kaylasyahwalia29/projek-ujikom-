<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use Illuminate\Http\Request;
use Validator;

class ProdukController extends Controller
{
    // Mendapatkan semua produk
    public function index()
    {
        $produk = Produk::all();
        return response()->json([
            'success' => true,
            'message' => 'Berhasil mendapatkan produk',
            'data'    => $produk,
        ], 200);
    }

    // Menyimpan produk baru
public function store(Request $request)
{
    $validate = Validator::make($request->all(), [
        'name_produk'      => 'required',
        'desc_produk'      => 'required',
        'harga_produk'     => 'required',
        'stok_produk'      => 'required',
        'id_kategori'      => 'required',
        'image_produk'     => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // validasi file
    ]);

    if ($validate->fails()) {
        return response()->json([
            'success' => false,
            'message' => 'Validasi Gagal',
            'data'    => $validate->errors(),
        ], 422);
    }

    try {
        $produk = new Produk();
        $produk->name_produk     = $request->name_produk;
        $produk->desc_produk     = $request->desc_produk;
        $produk->harga_produk    = $request->harga_produk;
        $produk->stok_produk     = $request->stok_produk;
        $produk->id_kategori     = $request->id_kategori;

        // Proses upload image jika ada
        if ($request->hasFile('image_produk')) {
            $image = $request->file('image_produk');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->storeAs('public/images', $imageName); // simpan ke storage/app/public/images
            $produk->image_produk = 'storage/images/' . $imageName; // simpan path
        }

        $produk->save();

        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Dibuat',
            'data'    => $produk,
        ], 201);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Terjadi Kesalahan',
            'errors'  => $e->getMessage(),
        ], 500);
    }
}


    // Mendapatkan produk berdasarkan ID
    public function show($id)
    {
        $produk = Produk::find($id);
        if (! $produk) {
            return response()->json(['message' => 'Produk tidak ditemukan'], 404);
        }

        return response()->json([
            'message' => 'Berhasil mendapatkan produk',
            'data'    => $produk,
        ]);
    }

    // Mengupdate produk berdasarkan ID
    public function update(Request $request, $id)
    {
        $produk = Produk::find($id);
        if (! $produk) {
            return response()->json(['message' => 'Produk tidak ditemukan'], 404);
        }

        $validatedData = $request->validate([
            'name_produk'  => 'required',
            'desc_produk'  => 'required',
            'harga_produk' => 'required',
            'stok_produk'  => 'required',
            'id_kategori'  => 'required',
        ]);

        $produk->update($validatedData);

        return response()->json([
            'message' => 'Produk berhasil diperbarui',
            'data'    => $produk,
        ]);
    }

    // Menghapus produk berdasarkan ID
    public function destroy($id)
    {
        $produk = Produk::find($id);
        if (! $produk) {
            return response()->json(['message' => 'Produk tidak ditemukan'], 404);
        }

        $produk->delete();

        return response()->json(['message' => 'Produk berhasil dihapus']);
    }
}
