<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $r)
    {
        $validator = Validator::make($r->all(), [
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        User::create([
            'name' => $r->name,
            'email' => $r->email,
            'password' => bcrypt($r->password),
            'role' => 'pengguna'
        ]);

        return response()->json([
            'message' => 'register berhasil'
        ]);
    }

    public function login(Request $r)
    {
        if (!Auth::attempt($r->only('email','password'))) {
            return response()->json([
                'message'=>'login gagal'
            ],401);
        }

        return response()->json([
            'message'=>'login sukses',
            'user'=>Auth::user()
        ]);
    }
}