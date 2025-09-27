<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataUji extends Model
{
    use HasFactory;

    // Nama tabel (opsional, karena Laravel sudah bisa detect "data_uji")
    protected $table = 'data_uji';

    // Kolom yang bisa diisi massal
    protected $fillable = [
        'nib',
        'nama_perusahaan',
        'skala_usaha',
        'nama_proyek',
        'alamat_usaha',
        'kecamatan_usaha',
        'kelurahan_usaha',
        'jenis_usaha',
        'nomor_identitas_user',
        'email',
        'nomor_telp',
        'modal_usaha',
        'tenaga_kerja',
        'label',
    ];
}
