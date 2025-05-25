<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Gedung;

class PieTipeGedung extends Component
{
    public $labels = ['Besar', 'Sedang', 'Kecil'];
    public $data = [];

    public function mount()
    {
        $this->data = [
            Gedung::where('tipe_gedung', 'Besar')->count(),
            Gedung::where('tipe_gedung', 'Sedang')->count(),
            Gedung::where('tipe_gedung', 'Kecil')->count(),
        ];
    }

    public function render()
    {
        return view('livewire.pie-tipe-gedung');
    }
}
