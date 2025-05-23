<?php

namespace App\Filament\Resources\ReservasiResource\Pages;

use App\Filament\Resources\ReservasiResource;
use App\Models\Reservasi;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class CreateReservasi extends CreateRecord
{
    protected static string $resource = ReservasiResource::class;

    public function getHeading(): string
    {
        return 'Buat Reservasi';
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = Auth::id();
        $data['status'] = 'pending';
        $data['batas_waktu_reservasi'] = now()->addDay();
    
        if (!isset($data['waktu_mulai']) || !isset($data['waktu_selesai'])) {
            Notification::make()
                ->title('Tanggal belum lengkap.')
                ->danger()
                ->send();
            $this->halt();
        }
    
        $waktuMulai = Carbon::parse($data['waktu_mulai']);
        $waktuSelesai = Carbon::parse($data['waktu_selesai']);
        $tanggalReservasi = $waktuMulai->toDateString();
        $durasiMenit = $waktuMulai->diffInMinutes($waktuSelesai);
    
        if ($durasiMenit < 240 || $durasiMenit > 720) {
            Notification::make()
                ->title('Durasi tidak valid.')
                ->body('Durasi reservasi harus antara 4 hingga 12 jam.')
                ->danger()
                ->send();
            $this->halt();
        }
    
        $conflicting = Reservasi::where('gedung_id', $data['gedung_id'])
            ->where('status', 'disetujui')
            ->whereDate('waktu_mulai', $tanggalReservasi)
            ->where(function ($query) use ($waktuMulai, $waktuSelesai) {
                $query->whereBetween('waktu_mulai', [$waktuMulai, $waktuSelesai])
                    ->orWhereBetween('waktu_selesai', [$waktuMulai, $waktuSelesai])
                    ->orWhere(function ($q) use ($waktuMulai, $waktuSelesai) {
                        $q->where('waktu_mulai', '<=', $waktuMulai)
                          ->where('waktu_selesai', '>=', $waktuSelesai);
                    });
            })
            ->exists();
    
        if ($conflicting) {
            Notification::make()
                ->title('Bentrok dengan reservasi lain.')
                ->danger()
                ->send();
            $this->halt();
        }
    
        $reservasiSebelumnya = Reservasi::where('gedung_id', $data['gedung_id'])
            ->where('status', 'disetujui')
            ->whereDate('waktu_mulai', $tanggalReservasi)
            ->orderBy('waktu_selesai', 'desc')
            ->first();
    
        if ($reservasiSebelumnya) {
            $selisih = Carbon::parse($reservasiSebelumnya->waktu_selesai)->diffInMinutes($waktuMulai, false);
            if ($selisih < 120) {
                Notification::make()
                    ->title('Terlalu dekat dengan reservasi sebelumnya.')
                    ->body('Minimal jeda waktu antar reservasi adalah 2 jam.')
                    ->danger()
                    ->send();
                $this->halt();
            }
        }
    
        $totalDurasiHariIni = Reservasi::where('gedung_id', $data['gedung_id'])
            ->where('status', 'disetujui')
            ->whereDate('waktu_mulai', $tanggalReservasi)
            ->get()
            ->reduce(function ($carry, $item) {
                return $carry + Carbon::parse($item->waktu_mulai)->diffInMinutes($item->waktu_selesai);
            }, 0);
    
        if (($totalDurasiHariIni + $durasiMenit) > 720) {
            $sisa = 720 - $totalDurasiHariIni;
            $sisaJam = round($sisa / 60, 2);
    
            Notification::make()
                ->title('Total pemakaian gedung hari itu melebihi 12 jam.')
                ->body("Sisa waktu hanya $sisaJam jam, tidak cukup untuk reservasi ini.")
                ->danger()
                ->send();
            $this->halt();
        }
    
        return $data;
    }
    
}
