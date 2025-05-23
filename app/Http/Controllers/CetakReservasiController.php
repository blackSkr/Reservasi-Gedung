<?php

namespace App\Http\Controllers;

use App\Models\Fasilitas;
use App\Models\Gedung;
use App\Models\Reservasi;
use Barryvdh\DomPDF\Facade\Pdf;
use GuzzleHttp\Psr7\Request;
use Illuminate\Container\Attributes\Auth;

class CetakReservasiController extends Controller
{
    public function cetak($id)
    {
        $reservasi = Reservasi::with('user', 'fasilitas')->findOrFail($id);
    
        $pdf = Pdf::loadView('pdf.reservasi', ['reservasiList' => collect([$reservasi])]);
        return $pdf->stream('data-reservasi.pdf');
    }
    
    public function cetakReservasi(Request $request)
    {
        $user = Auth::user();

        if ($user->hasRole(['admin', 'superadmin'])) {
            // Admin bisa cetak semua atau satu per ID
            $reservasiList = $request->has('id')
                ? Reservasi::where('id', $request->id)->get()
                : Reservasi::all();
        } else {
            $reservasiList = Reservasi::where('user_id', $user->id)->get();
        }

        return view('reservasi.cetak', compact('reservasiList'));
    }
}

