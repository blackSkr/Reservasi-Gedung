<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Reservasi;
use Illuminate\Support\Facades\DB;

class TopGedung extends Component
{
    public $topGedung = [];

    public function mount()
    {
        $this->topGedung = Reservasi::join('gedung', 'reservasi.gedung_id', '=', 'gedung.id')
            ->select('gedung.nama_gedung as nama_gedung', DB::raw('count(*) as total'))
            ->groupBy('gedung.nama_gedung')
            ->orderByDesc('total')
            ->limit(3)
            ->get();
    }

    public function render()
    {
        return view('livewire.top-gedung');
    }
}
