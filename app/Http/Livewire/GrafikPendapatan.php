<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Reservasi;
use Carbon\Carbon;

class GrafikPendapatan extends Component
{
    public $labels = [];
    public $data = [];

    public function mount()
    {
        $bulan = collect(range(0, 5))->map(function ($i) {
            return now()->subMonths($i)->startOfMonth();
        })->reverse();

        foreach ($bulan as $date) {
            $total = Reservasi::whereMonth('created_at', $date->month)
                ->whereYear('created_at', $date->year)
                ->sum('total_reservasi'); // Pastikan kolomnya 'harga'

            $this->labels[] = $date->format('M Y');
            $this->data[] = $total;
        }
    }

    public function render()
    {
        return view('livewire.grafik-pendapatan');
    }
}
