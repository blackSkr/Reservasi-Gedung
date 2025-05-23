<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;

class Pendapatan extends Model
{
    //
    use HasUlids;
    protected $table = "reservasi";

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
        "fasilitas_id"
    ];
}
