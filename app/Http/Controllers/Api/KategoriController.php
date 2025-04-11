<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Validator;

class KategoriController extends Controller
{
    // Mendapatkan semua kategori
    public function index()
    {
        $kategori = Kategori::all();
        return response()->json([
            'success' => true,
            'message' => 'Berhasil mendapatkan kategori',
            'data'    => $kategori,
        ], 200);
    }

    // Menyimpan kategori baru
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name_kategori' => 'required',
        ]);

        if ($validate->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi Gagal',
                'data'    => $validate->errors(),
            ], 422);
        }

        try {
            $kategori                = new Kategori();
            $kategori->name_kategori = $request->name_kategori;
            $kategori->save();

            return response()->json([
                'success' => true,
                'message' => 'Data Berhasil Dibuat',
                'data'    => $kategori,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi Kesalahan',
                'errors'  => $e->getMessage(),
            ], 500);
        }
    }

    // Mendapatkan kategori berdasarkan ID
    public function show($id)
    {
        $kategori = Kategori::find($id);
        if (! $kategori) {
            return response()->json(['message' => 'Kategori tidak ditemukan'], 404);
        }

        return response()->json([
            'message' => 'Berhasil mendapatkan kategori',
            'data'    => $kategori,
        ]);
    }

    // Mengupdate kategori berdasarkan ID
    public function update(Request $request, $id)
    {
        $kategori = Kategori::find($id);
        if (! $kategori) {
            return response()->json(['message' => 'Kategori tidak ditemukan'], 404);
        }

        $validatedData = $request->validate([
            'name_kategori' => 'required|string|max:255',
        ]);

        $kategori->update($validatedData);

        return response()->json([
            'message' => 'Kategori berhasil diperbarui',
            'data'    => $kategori,
        ]);
    }

    // Menghapus kategori berdasarkan ID
    public function destroy($id)
    {
        $kategori = Kategori::find($id);
        if (! $kategori) {
            return response()->json(['message' => 'Kategori tidak ditemukan'], 404);
        }

        $kategori->delete();

        return response()->json(['message' => 'Kategori berhasil dihapus']);
    }
}
