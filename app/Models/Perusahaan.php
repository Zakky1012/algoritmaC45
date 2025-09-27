<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perusahaan extends Model
{
    use HasFactory;

    protected $table = 'perusahaans';

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
