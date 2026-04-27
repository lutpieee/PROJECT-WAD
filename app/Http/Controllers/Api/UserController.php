<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // GET all users (ADMIN)
    public function index()
    {
        return response()->json(User::all());
    }

    // POST create user (ADMIN)
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'pengguna'
        ]);

        return response()->json($user, 201);
    }

    // GET user by id (ADMIN)
    public function show($id)
    {
        return response()->json(User::findOrFail($id));
    }

    // PUT update user (ADMIN)
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $user->update([
            'name' => $request->name ?? $user->name,
            'email' => $request->email ?? $user->email
        ]);

        return response()->json($user);
    }

    // DELETE user (ADMIN)
    public function destroy($id)
    {
        User::destroy($id);
        return response()->json(['message' => 'User deleted']);
    }
}