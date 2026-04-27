<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ruangan extends Model
{
    use HasFactory;

    /**
     * Kolom yang boleh diisi (Mass Assignment)
     */
    protected $fillable = [
        'nomor_ruangan',
        'kapasitas',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    public function jadwal()
    {
        return $this->hasMany(Jadwal::class);
    }
}
