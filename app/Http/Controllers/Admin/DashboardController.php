<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Mengambil data nyata dari database untuk ditampilkan di Blade
        $data = [
            'total_users' => User::count(),
            'total_ruangan' => 12,    // Contoh statis, bisa diganti Model::count()
            'pending_approval' => 5,  // Contoh statis
            'total_peminjaman' => 150 // Contoh statis
        ];

        // Mengirim variabel $data ke resources/views/admin/dashboard.blade.php
        return view('admin.dashboard', compact('data'));
    }
}