<?php

namespace App\Imports;

use App\Models\Umkm;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UmkmImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // Skip baris kosong (misal NIB kosong)
        if (!isset($row['nib']) || empty(trim($row['nib']))) {
            return null;
        }

        // Cek apakah NIB sudah ada → kalau ada, skip
        if (Umkm::where('nib', $row['nib'])->exists()) {
            return null;
        }

        return new Umkm([
            'nib' => $row['nib'],
            'nama_perusahaan' => $row['nama_perusahaan'] ?? null,
            'skala_usaha' => $row['skala_usaha'] ?? null,
            'nama_proyek' => $row['nama_proyek'] ?? null,
            'alamat_usaha' => $row['alamat_usaha'] ?? null,
            'kecamatan_usaha' => $row['kecamatan_usaha'] ?? null,
            'kelurahan_usaha' => $row['kelurahan_usaha'] ?? null,
            'jenis_usaha' => $row['jenis_usaha'] ?? null,
            'nomor_identitas_user' => $row['nomor_identitas_user'] ?? null,
            'email' => $row['email'] ?? null,
            'nomor_telp' => $row['nomor_telp'] ?? null,
            'modal_usaha' => isset($row['modal_usaha']) 
                                ? (float) str_replace(['.', ','], '', $row['modal_usaha']) 
                                : 0,
            'tenaga_kerja' => isset($row['tenaga_kerja']) ? (int) $row['tenaga_kerja'] : 0,
            // 'label' sengaja tidak diisi karena nanti dihitung pakai rule
        ]);
    }
}
