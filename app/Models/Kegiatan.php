<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    use HasFactory;

    // Nama tabel (opsional jika mengikuti konvensi Laravel)
    protected $table = 'kegiatan';

    // Kolom yang bisa diisi massal
    protected $fillable = [
        'nama',
        'foto',
        'tanggal_kegiatan',
        'deskripsi',
    ];

    // Jika ingin tipe data tanggal otomatis di-cast
    protected $dates = [
        'tanggal_kegiatan',
        'created_at',
        'updated_at',
    ];
}
