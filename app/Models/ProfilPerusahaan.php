<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;

class ProfilPerusahaan extends Model
{
    //
    protected $table = "profil_perusahaan";
    use HasUlids;
    protected $casts = [
        "update"=> "datetime",
    ];
    protected $fillable = [
        'nama_perusahaan',
        'alamat_jalan',
        'email',
        'nomor_telepon',
        'alamat_gedung',
        'kota',
        'provinsi',
        'qr_pembayaran',
        'nomor_rekening',
        'nama_rekening',
        'status',
        'update',

    ];
}
