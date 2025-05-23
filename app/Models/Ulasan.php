<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;

class Ulasan extends Model
{
    //
    protected $table = "ulasan";
    use HasUlids;
    protected $fillable = [
        'id',
        'user_id',
        'judul_ulasan',
        'ulasan',
        'bintang',
        'status',
    ];
    public function User(){
        return $this->belongsTo(User::class);
    }
    protected $cast =[
        'status' => 'boolean'
    ];
}
