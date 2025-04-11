<?php

namespace App\Http\Controllers;

use Alert;
use App\Models\informasi;
use Illuminate\Http\Request;

class InformasiController extends Controller
{

    public function index()
    {
        $informasi = informasi::all();
        confirmDelete('Delete', 'Apakah Kamu Yakin?');
        return view('admin.informasi.index', compact('informasi'));

    }

    public function create()
    {
        return view('admin.informasi.create');

    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name_informasi' => 'required|max:50',
            'desc_informasi' => 'required',
            'tgl_informasi' => 'required',
            'image_informasi' => 'required|max:4000|mimes:jpeg,png,jpg,gif,svg',
        ]);

        $informasi = new informasi();
        $informasi->name_informasi = $request->name_informasi;
        $informasi->desc_informasi = $request->desc_informasi;
        $informasi->tgl_informasi = $request->tgl_informasi;

        if ($request->hasFile('image_informasi')) {
            $img = $request->file('image_informasi');
            $name = rand(1000, 9999) . $img->getClientOriginalName();
            $img->move('images/informasi/', $name);
            $informasi->image_informasi = $name;
        }

        $informasi->save();
        Alert::success('Success', 'Data Berhasil Disimpan')->autoClose(1000);
        return redirect()->route('informasi.index');

    }

    public function show(informasi $informasi)
    {
        //
    }

    public function edit($id)
    {
        $informasi = informasi::findOrFail($id);
        return view('admin.informasi.edit', compact('informasi'));

    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name_informasi' => 'required|max:50',
            'desc_informasi' => 'required',
            'tgl_informasi' => 'required',
            // 'image_informasi' => 'required|max:4000|mimes:jpeg,png,jpg,gif,svg',
        ]);

        $informasi = informasi::findOrFail($id);
        $informasi->name_informasi = $request->name_informasi;
        $informasi->desc_informasi = $request->desc_informasi;
        $informasi->tgl_informasi = $request->tgl_informasi;

        if ($request->hasFile('image_informasi')) {
            $informasi->deleteImage(); // untuk hapus gambar sebelum diganti gambar baru
            $img = $request->file('image_informasi');
            $name = rand(1000, 9999) . $img->getClientOriginalName();
            $img->move('images/informasi/', $name);
            $informasi->image_informasi = $name;

        }

        $informasi->save();
        Alert::success('Success', 'Data Berhasil Diubah')->autoClose(1000);
        return redirect()->route('informasi.index');

    }

    public function destroy($id)
    {
        $informasi = informasi::findOrFail($id);
        $informasi->delete();
        Alert::success('Success', 'Data Berhasil Di Hapus')->autoClose(1000);
        return redirect()->route('informasi.index');

    }
}
