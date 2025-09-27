<?php
namespace App\Http\Controllers;

use App\Models\Umkm;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    // Menampilkan semua data UMKM
    public function index(Request $request)
{
    // Ambil keyword pencarian dari input form
    $search = $request->get('search');

    // Query UMKM dengan pencarian
    $umkms = Umkm::query()
        ->when($search, function ($query, $search) {
            $query->where('nama_proyek', 'like', "%{$search}%")
                  ->orWhere('deskripsi', 'like', "%{$search}%");
        })
        ->paginate(5)
        ->withQueryString(); // supaya pagination tetap bawa parameter pencarian

    // Query Kegiatan (juga bisa menggunakan keyword yang sama untuk pencarian kegiatan)
    $kegiatans = \App\Models\Kegiatan::query()
        ->when($search, function ($query, $search) {
            $query->where('nama', 'like', "%{$search}%")
                  ->orWhere('deskripsi', 'like', "%{$search}%");
        })
        ->paginate(5)
        ->withQueryString();

    // Query User (bisa pagination juga, tanpa pencarian)
    $users = \App\Models\User::paginate(5);

    return view('welcome', compact('umkms', 'kegiatans', 'users', 'search'));
}


    public function umkm(Request $request)
    {
        // Ambil keyword pencarian dari input form
        $search = $request->get('search');
    
        // Query UMKM dengan filter label 'layak' dan pencarian
        $umkms = Umkm::query()
            ->where('label', 'layak') // hanya tampilkan yg layak
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('nama_proyek', 'like', "%{$search}%")
                      ->orWhere('deskripsi', 'like', "%{$search}%");
                });
            })
            ->paginate(5)
            ->withQueryString(); // supaya pagination tetap bawa parameter pencarian
    
        return view('product.index', compact('umkms', 'search'));
    }
    

  
    
    

    // Menampilkan detail UMKM
public function show($id)
{
    // Cari data UMKM berdasarkan ID, jika tidak ada maka akan 404
    $umkm = Umkm::findOrFail($id);

    // Kirim data ke view 'umkm.show'
    return view('umkm.detail', compact('umkm'));
}

    
}

