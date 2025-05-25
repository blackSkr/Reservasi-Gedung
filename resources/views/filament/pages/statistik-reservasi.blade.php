<x-filament::page>
    {{-- <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100 mb-6">
        📊 Statistik Reservasi
    </h2> --}}
    {{-- Reservasi Terbaru (1 kolom full) --}}
    <div class="mt-6">
        @livewire('reservasi-terakhir')
    </div>
    {{-- Bar Chart + Line Chart (2 kolom jika lebar) --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        @livewire('grafik-reservasi-bulanan')
        @livewire('grafik-pendapatan')
    </div>

    {{-- Pie Chart + Top Gedung (2 kolom jika lebar) --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-6">
        @livewire('pie-tipe-gedung')
    </div>
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-6">
        @livewire('top-gedung')
    </div>


</x-filament::page>

