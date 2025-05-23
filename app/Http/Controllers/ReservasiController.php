<?php

namespace App\Http\Controllers;

use App\Models\ProfilPerusahaan;
use App\Models\Reservasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ReservasiController extends Controller
{
    public function bayar(Request $request, Reservasi $reservation)
    {
        $user = Auth::user(); // fix auth

        if (!$user || $reservation->user_id !== $user->id) {
            abort(403, 'Unauthorized action.');
        }

        if ($request->isMethod('post')) {
            $request->validate([
                'bukti_pembayaran' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            ]);

            $path = $request->file('bukti_pembayaran')->store('bukti-bayar', 'public');

            $reservation->update([
                'bukti_pembayaran' => $path,
                'status' => 'Sudah Membayar', 
            ]);
            return redirect('/admin/reservasis')->with('success', 'Bukti pembayaran berhasil diunggah. Menunggu verifikasi.');

        }
        $profil_perusahaan_tampil = ProfilPerusahaan::where('status', 'Tampil');

        return view('reservasi.bayar-reservasi', compact('reservation', 'profil_perusahaan_tampil'));
    }
}
