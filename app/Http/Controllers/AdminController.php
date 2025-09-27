<?php

namespace App\Http\Controllers;

use App\Models\Perusahaan;

use App\Models\Datauji;

use App\Models\Umkm;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Dashboard Admin
    public function index()
    {
        $totalDataUji   = DataUji::count();
        $totalPerusahaan = Perusahaan::count();
        $totalUmkm      = Umkm::count();
        $totalUser      = User::count();

        return view('admin.dashboard', compact(
            'totalDataUji',
            'totalPerusahaan',
            'totalUmkm',
            'totalUser'
        ));
    }

    // Manajemen User
    public function users()
    {
        return view('admin.users'); // bikin view: resources/views/admin/users.blade.php
    }

    // Manajemen Event
    public function events()
    {
        return view('admin.events'); // bikin view: resources/views/admin/events.blade.php
    }
}
