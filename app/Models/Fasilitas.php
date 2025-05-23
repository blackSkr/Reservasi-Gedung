<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Fasilitas extends Model
{
    //
    protected $table = "fasilitas";
    protected $fillable = [
        "nama_fasilitas",
        "jumlah",
        "harga",
        "status",
    ];
    public function reservasi(): HasMany{
        return $this->hasMany(Fasilitas::class);
    }
}
