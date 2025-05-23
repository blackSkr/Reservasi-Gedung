<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservasi extends Model
{
    //
    protected $table = "reservasi";
    // use HasUlids;
    protected $casts = [
        'waktu_mulai' => 'datetime',
        'waktu_selesai' => 'datetime',
    ];
    protected $fillable = [

        "gedung_id",
        "user_id",
        "nominal",
        "waktu_reservasi",
        "waktu_mulai",
        "waktu_selesai",
        "status",
        "catatan",
        "total_reservasi",
        "fasilitas_id",
        "bukti_pembayaran",
        "batas_waktu_reservasi"
    ];
    public function gedung(){
        return $this->belongsTo(Gedung::class);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function fasilitas()
    {
        return $this->belongsTo(Fasilitas::class, 'fasilitas_id');
    }
    public function pengembalian()
    {
        return $this->belongsTo(Pengembalian::class,'pengembalian_id');
    }
}
