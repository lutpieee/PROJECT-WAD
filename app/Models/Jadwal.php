<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Peminjaman;

class Jadwal extends Model
{
    protected $fillable = [
        'ruangan_id',
        'tanggal',
        'jam_mulai',
        'jam_selesai',
        'status'
    ];

    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class);
    }

    public function peminjamans()
    {
        return $this->hasMany(Peminjaman::class, 'jadwal_id');
    }
}
