<?php

namespace App\Http\Controllers;

use Alert;
use App\Models\method;
use Illuminate\Http\Request;

class MethodController extends Controller
{

    public function index()
    {
        $method = method::all();
        confirmDelete('Delete', 'Apakah Kamu Yakin?');
        return view('admin.method.index', compact('method'));

    }

    public function create()
    {
        return view('admin.method.create');

    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name_method' => 'required',
        ]);

        $method = new method();
        $method->name_method = $request->name_method;

        $method->save();
        Alert::success('Success', 'Data Berhasil Disimpan')->autoClose(1000);
        return redirect()->route('method.index');

    }

    public function show(method $method)
    {
        //
    }

    public function edit($id)
    {
        $method = method::findOrFail($id);
        return view('admin.method.edit', compact('method'));

    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name_method' => 'required',
        ]);

        $method = method::findOrFail($id);
        $method->name_method = $request->name_method;

        $method->save();
        Alert::success('Success', 'Data Berhasil Di Ubah')->autoClose(1000);
        return redirect()->route('method.index');

    }

    public function destroy($id)
    {
        $method = method::findOrFail($id);
        $method->delete();
        Alert::success('Success', 'Data Berhasil Di Hapus')->autoClose(1000);
        return redirect()->route('method.index');

    }
}
