<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;

class Gedung extends Model
{
    //
    protected $table = "gedung";
    use HasUlids;
    protected $fillable = [
        'nama_gedung',
        'tipe_gedung',
        'foto_gedung',
        'harga',
        'kapasitas',
        'fasilitas',
        'status',
        'deskripsi',
    ];

}
