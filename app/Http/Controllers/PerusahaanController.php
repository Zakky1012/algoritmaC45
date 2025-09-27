<?php

namespace App\Http\Controllers;

use App\Models\Perusahaan;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\PerusahaanImport;
use Illuminate\Support\Facades\Storage;


class PerusahaanController extends Controller
{
    // 📍 Tampilkan semua data di view index
    public function index()
    {
        $perusahaans = Perusahaan::paginate(20); // tampil 20 data per halaman
        return view('perusahaans.index', compact('perusahaans'));
    }
    

    // 📍 Tampilkan form create
    public function create()
    {
        return view('perusahaans.create');
    }

    // 📍 Simpan data baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nib' => 'required|string|max:255',
            'nama_perusahaan' => 'required|string|max:255',
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

        Perusahaan::create($validated);

        return redirect()->route('perusahaans.index')->with('success', 'Data berhasil ditambahkan');
    }

    // 📍 Tampilkan detail
    public function show($id)
    {
        $perusahaan = Perusahaan::findOrFail($id);
        return view('perusahaans.show', compact('perusahaan'));
    }

    // 📍 Form edit
    public function edit($id)
    {
        $perusahaan = Perusahaan::findOrFail($id);
        return view('perusahaans.edit', compact('perusahaan'));
    }

    // 📍 Update data
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nib' => 'required|string|max:255',
            'nama_perusahaan' => 'required|string|max:255',
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

        $perusahaan = Perusahaan::findOrFail($id);
        $perusahaan->update($validated);

        return redirect()->route('perusahaans.index')->with('success', 'Data berhasil diperbarui');
    }

    // 📍 Hapus data
    public function destroy($id)
    {
        $perusahaan = Perusahaan::findOrFail($id);
        $perusahaan->delete();

        return redirect()->route('perusahaans.index')->with('success', 'Data berhasil dihapus');
    }


    public function preprocess()
    {
        // ambil data tanpa pagination agar semua data tersedia
        $data = Perusahaan::all();
    
        // lakukan mapping
        $result = $data->map(function ($perusahaan) {
            // Mapping Skala Usaha
            $skalaMap = [
                'Rendah' => 0,
                'Menengah Rendah' => 1,
                'Menengah Tinggi' => 2,
                'Tinggi' => 3,
            ];
            $perusahaan->skala_usaha = $skalaMap[$perusahaan->skala_usaha] ?? null;
    
            // Mapping Modal Usaha
            if ($perusahaan->modal_usaha < 5000000) {
                $perusahaan->modal_usaha = 1;
            } elseif ($perusahaan->modal_usaha <= 50000000) {
                $perusahaan->modal_usaha = 2;
            } else {
                $perusahaan->modal_usaha = 3;
            }
    
            // Mapping Tenaga Kerja
            if ($perusahaan->tenaga_kerja >= 1 && $perusahaan->tenaga_kerja <= 4) {
                $perusahaan->tenaga_kerja = 1;
            } elseif ($perusahaan->tenaga_kerja <= 19) {
                $perusahaan->tenaga_kerja = 2;
            } elseif ($perusahaan->tenaga_kerja <= 99) {
                $perusahaan->tenaga_kerja = 3;
            } else {
                $perusahaan->tenaga_kerja = 4;
            }
    
            // Mapping Label
            $labelMap = [
                'Tidak layak' => 0,
                'pertimbangkan' => 1,
                'layak' => 2,
            ];
            $perusahaan->label = $labelMap[$perusahaan->label] ?? null;
    
            return $perusahaan;
        });
    
        // simpan ke session untuk perhitungan C4.5 selanjutnya
        session(['preprocessed_data' => $result->toArray()]);
    
        // kirim ke view dengan pagination untuk tampilan
        $perusahaans = Perusahaan::paginate(10);
    
        return view('perusahaans.preproses', [
            'perusahaans' => $perusahaans,
            'result' => $result
        ]);
    }

    public function hitungc45()
    {
        // Ambil dataset dari session
        $data = session('preprocessed_data', []);
    
        if(empty($data)) {
            return redirect()->route('perusahaan.preprocess')
                             ->with('error', 'Data preprocessed belum tersedia.');
        }
    
        $attributes = ['skala_usaha', 'modal_usaha', 'tenaga_kerja'];
    
        $results = [];
        $details = [];
    
        foreach($attributes as $attr) {
            $info = $this->detailedGain($data, $attr);
            $results[$attr] = $info['gain'];
            $details[$attr] = $info['detail'];
        }
    
        // Tentukan atribut dengan gain tertinggi
        arsort($results);
        $bestAttribute = key($results);
    
        // Simpan hasil ke session untuk digunakan di tahap selanjutnya (pohon & rule)
        session([
            'c45_results' => $results,
            'c45_best_attribute' => $bestAttribute,
            'c45_details' => $details
        ]);
    
        // Kirim data ke view
        return view('perusahaans.c45', [
            'results' => $results,
            'bestAttribute' => $bestAttribute,
            'details' => $details
        ]);
    }
    
    
    /**
     * Hitung gain dan tampilkan detail per nilai atribut
     */
    private function detailedGain($data, $attribute)
    {
        $totalEntropy = $this->entropy($data);
    
        // Kelompokkan data berdasarkan nilai atribut
        $subsets = [];
        foreach($data as $row) {
            $val = $row[$attribute];
            $subsets[$val][] = $row;
        }
    
        $subsetEntropy = 0;
        $detail = [];
    
        foreach($subsets as $val => $subset) {
            $e = $this->entropy($subset);
            $weight = count($subset) / count($data);
            $subsetEntropy += $weight * $e;
    
            $detail[] = [
                'nilai' => $val,
                'jumlah' => count($subset),
                'entropy' => round($e, 4),
                'bobot' => round($weight, 4),
                'hasil' => round($weight * $e, 4)
            ];
        }
    
        $gain = $totalEntropy - $subsetEntropy;
    
        return [
            'gain' => round($gain, 4),
            'detail' => [
                'entropy_parent' => round($totalEntropy, 4),
                'entropy_child' => round($subsetEntropy, 4),
                'per_nilai' => $detail
            ]
        ];
    }
    private function calculateGain($data, $attribute)
    {
        return $this->detailedGain($data, $attribute)['gain'];
    }
    
    /**
     * Hitung entropy
     */
    private function entropy($data)
    {
        $total = count($data);
        $counts = [];
    
        foreach($data as $row) {
            $label = $row['label'];
            if(!isset($counts[$label])) $counts[$label] = 0;
            $counts[$label]++;
        }
    
        $entropy = 0;
        foreach($counts as $count) {
            $p = $count / $total;
            if($p > 0){
                $entropy -= $p * log($p, 2);
            }
        }
    
        return $entropy;
    }
    
    
    public function generateRules()
    {
        $data = session('preprocessed_data', []);
        $gainResults = session('c45_results', []);
        $bestAttribute = session('c45_best_attribute', null);
    
        if (empty($data) || empty($gainResults) || !$bestAttribute) {
            return redirect()->route('perusahaan.c45')
                ->with('error', 'Data C4.5 belum tersedia. Lakukan perhitungan gain terlebih dahulu.');
        }
    
        // Pastikan data array
        $data = array_map(fn($row) => (array) $row, $data);
    
        // Tambahkan label
        foreach ($data as &$row) {
            $row['hasil_kelayakan'] = $row['label'];
        }
    
        // Bangun rules
        $rules = $this->buildRules($data, $gainResults);
    
        // Ubah ke JSON
        $rulesJson = json_encode($rules, JSON_PRETTY_PRINT);
    
        // Simpan ke file
        Storage::disk('local')->put('rules.json', $rulesJson);
    
        // Bisa juga disimpan ke session kalau mau dipakai cepat
        session(['c45_rules' => $rules]);
    
        // Debug dulu
        // dd($rules, $rulesJson);
    
    
        return view('perusahaans.rules', ['rules' => $rules]);
    }
    
    
    
    /**
     * Rekursif untuk membangun rule
     */
    private function buildRules($data, $gainResults, $condition = '')
    {
        if (empty($data)) return [];
    
        // pilih atribut dengan gain tertinggi
        arsort($gainResults);
        $bestAttribute = array_key_first($gainResults);
    
        $rules = [];
        foreach (array_unique(array_column($data, $bestAttribute)) as $value) {
            $subset = array_filter($data, fn($row) => $row[$bestAttribute] == $value);
            $labels = array_unique(array_column($subset, 'hasil_kelayakan'));
            $newCondition = trim("$condition $bestAttribute = $value");
    
            if (count($labels) === 1) {
                // subset murni
                $rules[] = "IF $newCondition THEN Kelayakan: " . reset($labels);
            } else {
                // hitung gain baru kecuali atribut yg sudah dipakai
                $newGains = [];
                foreach (array_keys($gainResults) as $attr) {
                    if ($attr !== $bestAttribute) {
                        $newGains[$attr] = $this->calculateGain($subset, $attr);
                    }
                }
    
                if (empty($newGains)) {
                    // ambil label mayoritas
                    $counts = array_count_values(array_column($subset, 'hasil_kelayakan'));
                    $mostCommon = array_search(max($counts), $counts);
                    $rules[] = "IF $newCondition THEN Kelayakan: $mostCommon";
                } else {
                    $rules = array_merge(
                        $rules,
                        $this->buildRules($subset, $newGains, "$newCondition AND")
                    );
                }
            }
        }
    
        return $rules;
    }
    
    







public function import(Request $request)
{
    $request->validate([
        'file' => 'required|mimes:xlsx,xls'
    ]);

    Excel::import(new PerusahaanImport, $request->file('file'));

    return redirect()->route('perusahaans.index')->with('success', 'Data berhasil diimport!');
}

public function destroyAll()
{

    
    \App\Models\Perusahaan::truncate(); 
    return redirect()->route('perusahaans.index')->with('success', 'Semua data berhasil dihapus.');
}



}
