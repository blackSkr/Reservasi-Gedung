<?php

namespace App\Http\Controllers;

use App\Models\ProfilPerusahaan;
use Illuminate\Http\Request;
use App\Models\Gedung;
use App\Models\Reservasi;
use App\Models\Ulasan;
use App\Models\User;

class LandingPageController extends Controller
{
    public function index()
    {   
        $reservasis = Reservasi::all();
        $gedungs = Gedung::all();
        $users = User::all();
        $ulasans = Ulasan::all();
        $profil_perusahaans = ProfilPerusahaan::all();

        $profil_perusahaan_tampil = ProfilPerusahaan::where('Status', 'Tampil');
        $totalgedung = Gedung::Where('status', 'ready')->count();
        $totalreservasitampil = Reservasi::where('status', 'disetujui')->count();

        return view('landingpage.index', compact('gedungs', 'users', 'ulasans','totalgedung','totalreservasitampil','profil_perusahaans'));

    }
}


