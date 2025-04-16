<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $users = User::all();
        return response()->json(['users' => $users]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'name'          => 'required|string|max:255',
            'email'         => 'required|string|email|max:255|unique:users',
            'password'      => 'required|string|min:6',
            'no_telepon'    => 'nullable|string|max:15', // Menambahkan validasi untuk noTelepon
            'jenis_kelamin' => 'nullable|string|max:10', // Menambahkan validasi untuk jenisKelamin
            'tanggal_lahir' => 'nullable|date',          // Menambahkan validasi untuk tanggalLahir
            // 'status'        => 'nullable|string|max:20', // Menambahkan validasi untuk status
            // 'profile'       => 'nullable|string', 
            //   'role'          => 'required|string',       // Menambahkan validasi untuk profile
        ]);

        $user = User::create([
            'name'          => $request->name,
            'email'         => $request->email,
            'password'      => Hash::make($request->password),
            'no_telepon'    => $request->no_telepon,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tanggal_lahir' => $request->tanggal_lahir,
            // 'status'        => $request->status,
            // 'profile'       => $request->profile,
            //   'role'          => $request->role,
        ]);

        return response()->json(['message' => 'User  created successfully', 'user' => $user], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function show($id): JsonResponse
    {
        $user = User::findOrFail($id);
        return response()->json(['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return JsonResponse
     */
    public function update(Request $request, $id): JsonResponse
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name'          => 'sometimes|string|max:255',
            'email'         => "sometimes|string|email|max:255|unique:users,email,$id",
            'password'      => 'sometimes|string|min:6',
            'no_telepon'    => 'sometimes|nullable|string|max:15', // Menambahkan validasi untuk noTelepon
            'jenis_kelamin' => 'sometimes|nullable|string|max:10', // Menambahkan validasi untuk jenisKelamin
            'tanggal_lahir' => 'sometimes|nullable|date',          // Menambahkan validasi untuk tanggalLahir
            // 'status'        => 'sometimes|nullable|string|max:20', // Menambahkan validasi untuk status
            // 'profile'       => 'sometimes|nullable|string', 
            //        'role'          => 'sometimes|string',       // Menambahkan validasi untuk profile
        ]);

        $user->update($request->only(['name', 'email', 'role', 'no_telepon', 'jenis_kelamin', 'tanggal_lahir', 'status', 'profile']) + (
            $request->filled('password') ? ['password' => Hash::make($request->password)] : []
        ));

        return response()->json(['message' => 'User  updated successfully', 'user' => $user]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json(['message' => 'User deleted successfully']);
    }
}
