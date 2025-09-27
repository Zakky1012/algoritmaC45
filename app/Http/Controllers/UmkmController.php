<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Umkm;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\UmkmImport; 
use Barryvdh\DomPDF\Facade\Pdf; 
class UmkmController extends Controller
{
    public function index()
    {
        $umkms = Umkm::paginate(10);
        return view('umkm.index', compact('umkms'));
    }

    public function create()
    {
        return view('umkm.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'nib' => 'required|unique:umkm,nib',
        'nama_perusahaan' => 'required',
        'skala_usaha' => 'required',
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
    ]);

    $data = $request->all();

    // Simpan nilai asli
    $originalData = $data;

    // --- Preprocess skala usaha, modal, tenaga kerja untuk prediksi label ---
    $skalaMap = [
        'Rendah' => 0,
        'Menengah Rendah' => 1,
        'Menengah Tinggi' => 2,
        'Tinggi' => 3,
    ];
    $skalaUsahaPre = $skalaMap[$data['skala_usaha']] ?? null;

    // Modal usaha
    $modalUsahaPre = null;
    if (isset($data['modal_usaha'])) {
        if ($data['modal_usaha'] < 5000000) {
            $modalUsahaPre = 1;
        } elseif ($data['modal_usaha'] <= 50000000) {
            $modalUsahaPre = 2;
        } else {
            $modalUsahaPre = 3;
        }
    }

    // Tenaga kerja
    $tenagaKerjaPre = null;
    if (isset($data['tenaga_kerja'])) {
        if ($data['tenaga_kerja'] >= 1 && $data['tenaga_kerja'] <= 4) {
            $tenagaKerjaPre = 1;
        } elseif ($data['tenaga_kerja'] <= 19) {
            $tenagaKerjaPre = 2;
        } elseif ($data['tenaga_kerja'] <= 99) {
            $tenagaKerjaPre = 3;
        } else {
            $tenagaKerjaPre = 4;
        }
    }

    // --- Ambil rules ---
    $rulesPath = storage_path('app/private/rules.json');
    $rules = [];
    if (file_exists($rulesPath)) {
        $rules = json_decode(file_get_contents($rulesPath), true);
    }

    // --- Prediksi label berdasarkan skala_usaha ---
    $prediksi_label = null;
    if (!empty($rules)) {
        foreach ($rules as $rule) {
            if (preg_match('/IF skala_usaha = (\d+) THEN Kelayakan: (\d+)/', $rule, $matches)) {
                $rule_value = (int)$matches[1];
                $rule_label = (int)$matches[2];

                if ($skalaUsahaPre === $rule_value) {
                    $prediksi_label = $rule_label;
                    break;
                }
            }
        }
    }

    // Mapping label ke string
    $labelReverseMap = [
        0 => 'Tidak layak',
        1 => 'Pertimbangkan',
        2 => 'Layak',
    ];
    $data['label'] = $labelReverseMap[$prediksi_label] ?? null;

    // Simpan data UMKM
    $umkm = Umkm::create($data);

    // Supaya view tetap menampilkan data asli
    $umkm->skala_usaha = $originalData['skala_usaha'];
    $umkm->modal_usaha = $originalData['modal_usaha'];
    $umkm->tenaga_kerja = $originalData['tenaga_kerja'];

    return redirect()->route('umkm.index')->with('success', 'Data UMKM berhasil ditambahkan dan label diisi otomatis.');
}


    public function edit($id)
    {
        $umkm = Umkm::findOrFail($id);
        return view('umkm.edit', compact('umkm'));
    }

    public function update(Request $request, $id)
    {
        $umkm = Umkm::findOrFail($id);
    
        $request->validate([
            'nib' => 'required|unique:umkm,nib,' . $id,
            'nama_perusahaan' => 'required',
            'skala_usaha' => 'required',
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
            'deskripsi' => 'nullable|string',
            'harga' => 'nullable|numeric', // ✅ validasi harga
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // ✅ validasi foto
        ]);
    
        // Ambil semua input kecuali image (nanti di-handle khusus)
        $data = $request->except('image');
    
        // --- Upload image jika ada ---
        if ($request->hasFile('image')) {
            // Simpan di storage/app/public/umkm
            $path = $request->file('image')->store('umkm', 'public');
            $data['image'] = $path;
        }
    
        // Simpan nilai asli untuk dikembalikan ke view
        $originalData = $request->all();
    
        // --- Preprocess skala usaha, modal, tenaga kerja untuk prediksi label ---
        $skalaMap = [
            'Rendah' => 0,
            'Menengah Rendah' => 1,
            'Menengah Tinggi' => 2,
            'Tinggi' => 3,
        ];
        $skalaUsahaPre = $skalaMap[$data['skala_usaha']] ?? null;
    
        // Modal usaha
        $modalUsahaPre = null;
        if (isset($data['modal_usaha'])) {
            if ($data['modal_usaha'] < 5000000) {
                $modalUsahaPre = 1;
            } elseif ($data['modal_usaha'] <= 50000000) {
                $modalUsahaPre = 2;
            } else {
                $modalUsahaPre = 3;
            }
        }
    
        // Tenaga kerja
        $tenagaKerjaPre = null;
        if (isset($data['tenaga_kerja'])) {
            if ($data['tenaga_kerja'] >= 1 && $data['tenaga_kerja'] <= 4) {
                $tenagaKerjaPre = 1;
            } elseif ($data['tenaga_kerja'] <= 19) {
                $tenagaKerjaPre = 2;
            } elseif ($data['tenaga_kerja'] <= 99) {
                $tenagaKerjaPre = 3;
            } else {
                $tenagaKerjaPre = 4;
            }
        }
    
        // --- Ambil rules ---
        $rulesPath = storage_path('app/private/rules.json');
        $rules = [];
        if (file_exists($rulesPath)) {
            $rules = json_decode(file_get_contents($rulesPath), true);
        }
    
        // --- Prediksi label berdasarkan skala_usaha ---
        $prediksi_label = null;
        if (!empty($rules)) {
            foreach ($rules as $rule) {
                if (preg_match('/IF skala_usaha = (\d+) THEN Kelayakan: (\d+)/', $rule, $matches)) {
                    $rule_value = (int)$matches[1];
                    $rule_label = (int)$matches[2];
    
                    if ($skalaUsahaPre === $rule_value) {
                        $prediksi_label = $rule_label;
                        break;
                    }
                }
            }
        }
    
        // Mapping label ke string
        $labelReverseMap = [
            0 => 'Tidak layak',
            1 => 'Pertimbangkan',
            2 => 'Layak',
        ];
        $data['label'] = $labelReverseMap[$prediksi_label] ?? null;
    
        // ✅ Update data UMKM termasuk harga
        $umkm->update($data);
    
        // Supaya view tetap menampilkan data asli
        $umkm->refresh(); // ambil data terbaru dari DB
        $umkm->skala_usaha = $originalData['skala_usaha'];
        $umkm->modal_usaha = $originalData['modal_usaha'];
        $umkm->tenaga_kerja = $originalData['tenaga_kerja'];
        $umkm->harga = $originalData['harga'] ?? null; // ✅ biar harga juga muncul di view
    
        return redirect()->route('umkm.index')->with('success', 'Data UMKM berhasil diperbarui dan label diisi otomatis.');
    }
    
    
    
    public function labels()
    {
        // Ambil semua data UMKM
        $umkms = Umkm::all();
    
        // Mapping skala usaha
        $skalaMap = [
            'Rendah' => 0,
            'Menengah Rendah' => 1,
            'Menengah Tinggi' => 2,
            'Tinggi' => 3,
        ];
    
        // Mapping label ke string
        $labelReverseMap = [
            0 => 'Tidak Layak',
            1 => 'Pertimbangkan',
            2 => 'Layak',
        ];
    
        // Ambil rules
        $rulesPath = storage_path('app/private/rules.json');
        $rules = [];
        if (file_exists($rulesPath)) {
            $rules = json_decode(file_get_contents($rulesPath), true);
        }
    
        // Preprocess & prediksi label lalu update database
        foreach ($umkms as $umkm) {
            // Skala Usaha
            $skala = $skalaMap[$umkm->skala_usaha] ?? null;
    
            // Modal Usaha
            if ($umkm->modal_usaha < 5000000) $modal = 1;
            elseif ($umkm->modal_usaha <= 50000000) $modal = 2;
            else $modal = 3;
    
            // Tenaga Kerja
            if ($umkm->tenaga_kerja >= 1 && $umkm->tenaga_kerja <= 4) $tenaga = 1;
            elseif ($umkm->tenaga_kerja <= 19) $tenaga = 2;
            elseif ($umkm->tenaga_kerja <= 99) $tenaga = 3;
            else $tenaga = 4;
    
            // Prediksi label berdasarkan rules
            $prediksi = null;
            foreach ($rules as $rule) {
                if (preg_match('/IF skala_usaha = (\d+) THEN Kelayakan: (\d+)/', $rule, $matches)) {
                    $rule_value = (int)$matches[1];
                    $rule_label = (int)$matches[2];
                    if ($skala === $rule_value) {
                        $prediksi = $rule_label;
                        break;
                    }
                }
            }
    
            // Mapping label ke string
            $label = $labelReverseMap[$prediksi] ?? 'Belum Diprediksi';
    
            // Update database
            $umkm->update(['label' => $label]);
        }
    
        return redirect()->route('umkm.index')->with('success', 'Label UMKM berhasil diperbarui sesuai rules.');
    }
    


    public function destroy($id)
    {
        $umkm = Umkm::findOrFail($id);
        $umkm->delete();

        return redirect()->route('umkm.index')->with('success', 'Data UMKM berhasil dihapus.');
    }

    public function show($id)
    {
        $umkm = Umkm::findOrFail($id);
        return view('umkm.show', compact('umkm'));
    }

    public function deleteAll()
    {
        // Hapus semua data UMKM
        Umkm::truncate();
    
        return redirect()->route('umkm.index')->with('success', 'Semua data UMKM berhasil dihapus.');
    }
    
    public function import(Request $request)
    {
        // Validasi file
        $request->validate([
            'file' => 'required|mimes:xlsx,csv'
        ]);

        // Import file
        Excel::import(new UmkmImport, $request->file('file'));

        return redirect()->route('umkm.index')->with('success', 'Data UMKM berhasil diimport!');
    }




    public function laporan()
    {
        $umkms = Umkm::all();
        return view('umkm.laporan', compact('umkms'));
    }

    public function exportPdf()
    {
        $umkms = Umkm::all();
        $pdf = Pdf::loadView('umkm.laporan_pdf', compact('umkms'));
        return $pdf->download('laporan_umkm.pdf');
    }
}
