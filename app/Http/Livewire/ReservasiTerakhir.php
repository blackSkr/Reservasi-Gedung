<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Reservasi;

class ReservasiTerakhir extends Component
{
    public $reservasi = [];

    public function mount()
    {
        $this->reservasi = Reservasi::with(['gedung', 'user'])
            ->orderByDesc('created_at')
            ->limit(5)
            ->get();
    }

    public function render()
    {
        return view('livewire.reservasi-terakhir');
    }
}
