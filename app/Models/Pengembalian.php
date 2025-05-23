<?php

namespace App\Models;

use App\Filament\Resources\PengembalianResource;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Redirect;

class Pengembalian extends Model
{
    use HasUlids, HasFactory;
    protected $table = 'pengembalian';
    protected $fillable = [
        'reservasi_id',
        'user_id',
        'keterangan',
        'total_pengembalian',
        'status_pengembalian',
        'bukti_pengembalian',
        'nomor_rekening',
        'nama_bank',
        'nama_pemilik',
        'refunded_at',
    ];
    
    protected $casts = [
        'refunded_at' => 'datetime',
    ];
    protected $attributes = [
        'status_pengembalian' => 'menunggu_verifikasi',
    ];
    public static function booted()
    {
        static::creating(function ($pengembalian) {
            if (self::where('reservasi_id', $pengembalian->reservasi_id)->exists()) {
                throw new \Exception('Refund untuk reservasi ini sudah diajukan.');
            }
        });
    
        static::updating(function ($pengembalian) {
            if (
                $pengembalian->isDirty('status_pengembalian') &&
                $pengembalian->status_pengembalian === 'selesai'
            ) {
                $pengembalian->refunded_at = now();
            }
        });
    
        static::updated(function ($pengembalian) {
            if ($pengembalian->status_pengembalian === 'selesai') {
                $reservasi = \App\Models\Reservasi::find($pengembalian->reservasi_id);
    
                if ($reservasi && $reservasi->status !== 'ditolak') {
                    $reservasi->update(['status' => 'ditolak']);
                }
            }
        });
    }
    // public function mount($record): void
    // {
    //     parent::mount($record);

    //     if (!in_array($this->record->status_pengembalian, ['menunggu_verifikasi'])) {
    //         Notification::make()
    //             ->title('Pengembalian tidak dapat diedit')
    //             ->body('Status pengembalian sudah disetujui atau selesai.')
    //             ->danger()
    //             ->send();

    //         Redirect::to(PengembalianResource::getUrl());
    //     }
    // }

    
            
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function reservasi()
    {
        return $this->belongsTo(Reservasi::class);
    }
    
}
