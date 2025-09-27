<?php

namespace App\Http\Controllers;

use App\Models\DataUji;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\DataUjiImport;


class DataUjiController extends Controller
{
    // 1. Tampilkan semua data
    public function index()
    {
        $datauji = DataUji::paginate(10);
        return view('datauji.index', compact('datauji'));
    }

    // 2. Form tambah data
    public function create()
    {
        return view('datauji.create');
    }

    // 3. Simpan data baru
    public function store(Request $request)
    {
        $request->validate([
            'nib' => 'required|unique:data_uji,nib',
            'nama_perusahaan' => 'required|string',
            'skala_usaha' => 'required|string',
            'nama_proyek' => 'nullable|string',
            'alamat_usaha' => 'nullable|string',
            'kecamatan_usaha' => 'nullable|string',
            'kelurahan_usaha' => 'nullable|string',
            'jenis_usaha' => 'nullable|string',
            'nomor_identitas_user' => 'nullable|string',
            'email' => 'nullable|email',
            'nomor_telp' => 'nullable|string',
            'modal_usaha' => 'nullable|numeric',
            'tenaga_kerja' => 'nullable|integer',
            'label' => 'required|string',
        ]);

        DataUji::create($request->all());

        return redirect()->route('datauji.index')
                         ->with('success', 'Data berhasil ditambahkan.');
    }

    // 4. Tampilkan detail data
    public function show(DataUji $datauji)
    {
        return view('datauji.show', compact('datauji'));
    }

    // 5. Form edit data
    public function edit(DataUji $datauji)
    {
        return view('datauji.edit', compact('datauji'));
    }

    // 6. Update data
    public function update(Request $request, DataUji $datauji)
    {
        $request->validate([
            'nib' => 'required|unique:data_uji,nib,' . $datauji->id,
            'nama_perusahaan' => 'required|string',
            'skala_usaha' => 'required|string',
            'nama_proyek' => 'nullable|string',
            'alamat_usaha' => 'nullable|string',
            'kecamatan_usaha' => 'nullable|string',
            'kelurahan_usaha' => 'nullable|string',
            'jenis_usaha' => 'nullable|string',
            'nomor_identitas_user' => 'nullable|string',
            'email' => 'nullable|email',
            'nomor_telp' => 'nullable|string',
            'modal_usaha' => 'nullable|numeric',
            'tenaga_kerja' => 'nullable|integer',
            'label' => 'required|string',
        ]);

        $datauji->update($request->all());

        return redirect()->route('datauji.index')
                         ->with('success', 'Data berhasil diperbarui.');
    }

    // 7. Hapus data
    public function destroy(DataUji $datauji)
    {
        $datauji->delete();
        return redirect()->route('datauji.index')
                         ->with('success', 'Data berhasil dihapus.');
    }

    public function import(Request $request)
{
    $request->validate([
        'file' => 'required|mimes:xlsx,xls,csv',
    ]);

    try {
        Excel::import(new DataUjiImport, $request->file('file'));
        return redirect()->route('datauji.index')->with('success', 'Data berhasil diimport.');
    } catch (\Exception $e) {
        return redirect()->route('datauji.index')->with('error', 'Terjadi kesalahan saat import: ' . $e->getMessage());
    }
}




    // 8. Hapus semua data
    public function destroyAll()
    {
        DataUji::truncate();
        return redirect()->route('datauji.index')
                         ->with('success', 'Semua data berhasil dihapus.');
    }









    public function testRule()
    {
        // Ambil semua data uji
        $datauji = \App\Models\DataUji::all();
    
        if ($datauji->isEmpty()) {
            return redirect()->route('datauji.index')->with('error', 'Data uji masih kosong.');
        }
    
        // Mapping untuk skala usaha
        $skalaMap = [
            'Rendah' => 0,
            'Menengah Rendah' => 1,
            'Menengah Tinggi' => 2,
            'Tinggi' => 3,
        ];
    
        // Mapping label
        $labelMap = [
            'Tidak layak' => 0,
            'pertimbangkan' => 1,
            'layak' => 2,
        ];
    
        $labelReverseMap = array_flip($labelMap); // Untuk menampilkan label kembali
    
        // Preprocess data uji
        $preprocessed = $datauji->map(function($d) use ($skalaMap, $labelMap) {
            $d->skala_usaha = $skalaMap[$d->skala_usaha] ?? null;
    
            if ($d->modal_usaha < 5000000) {
                $d->modal_usaha = 1;
            } elseif ($d->modal_usaha <= 50000000) {
                $d->modal_usaha = 2;
            } else {
                $d->modal_usaha = 3;
            }
    
            if ($d->tenaga_kerja >= 1 && $d->tenaga_kerja <= 4) {
                $d->tenaga_kerja = 1;
            } elseif ($d->tenaga_kerja <= 19) {
                $d->tenaga_kerja = 2;
            } elseif ($d->tenaga_kerja <= 99) {
                $d->tenaga_kerja = 3;
            } else {
                $d->tenaga_kerja = 4;
            }
    
            $d->label_asli = $labelMap[$d->label] ?? null;
    
            return $d;
        });
    
        // Ambil rules dari file JSON
        $rulesPath = storage_path('app/private/rules.json');
        if (!file_exists($rulesPath)) {
            return redirect()->route('datauji.index')->with('error', 'File rules.json tidak ditemukan.');
        }
    
        $rulesArray = json_decode(file_get_contents($rulesPath), true);
        if (empty($rulesArray)) {
            return redirect()->route('datauji.index')->with('error', 'Rules kosong. Silakan generate rules terlebih dahulu.');
        }
    
        // Prediksi label
        $predicted = $preprocessed->map(function($d) use ($rulesArray, $labelReverseMap) {
            $prediksi_label = null;
    
            foreach ($rulesArray as $rule) {
                if (preg_match('/IF skala_usaha = (\d+) THEN Kelayakan: (\d+)/', $rule, $matches)) {
                    $rule_value = (int)$matches[1];
                    $rule_label = (int)$matches[2];
    
                    if ($d->skala_usaha === $rule_value) {
                        $prediksi_label = $rule_label;
                        break;
                    }
                }
            }
    
            $d->prediksi_label = $prediksi_label;
            $d->status = ($d->label_asli === $prediksi_label) ? 'Cocok' : 'Tidak Cocok';
    
            $d->label_asli = $labelReverseMap[$d->label_asli] ?? null;
            $d->prediksi_label = $labelReverseMap[$d->prediksi_label] ?? null;
    
            return $d;
        });
    
        // Hitung persentase cocok
        $total = $predicted->count();
        $cocokCount = $predicted->where('status', 'Cocok')->count();
        $persentaseCocok = $total > 0 ? round(($cocokCount / $total) * 100, 2) : 0;
    
        // Kirim ke view
        return view('datauji.test-rule', compact('predicted', 'rulesArray', 'persentaseCocok'));
    }
    
    


}
