<?php

namespace App\Http\Controllers;

use Alert;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{

    public function index()
    {
        $users = User::all();
        confirmDelete('Delete', 'Apakah Kamu Yakin?');
        return view('admin.user.index', compact('users'));

    }

    public function create()
    {
        return view('admin.user.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|unique:users',
            'password' => 'required|min:8', // Add 'confirmed' if
            'isAdmin' => 'required',
        ]);
        $users = new User();
        $users->name = $request->name;
        $users->email = $request->email;
        $users->password = hash::make($request->password);
        $users->isAdmin = $request->isAdmin;
        $users->save();
        Alert::success('Success', 'data Berhasil Disimpan')->autoClose(1000);
        return redirect()->route('user.index')->with('success', 'User created successfully.');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $users = User::findOrFail($id);
        return view('admin.user.edit', compact('users'));

        $user->save();
        return redirect()->route('user.index');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required',
            'password' => 'required|min:8', // Add 'confirmed' if
            'isAdmin' => 'required',
        ]);
        $users = User::findOrFail($id);
        $users->name = $request->name;
        $users->email = $request->email;
        $users->password = hash::make($request->password);
        $users->isAdmin = $request->isAdmin;
        $users->save();
        Alert::success('Success', 'Data Berhasil Di Edit')->autoClose(1000);
        return redirect()->route('user.index')->with('success', 'User update successfully.');
    }

    public function destroy($id)
    {
        $users = User::findOrFail($id);
        $users->delete();
        Alert::success('Success', 'Data Berhasil Di Hapus')->autoClose(1000);
        return redirect()->route('user.index')->with('success', 'Koperasi deleted successfully');

    }
}
