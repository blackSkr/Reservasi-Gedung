<x-filament::page>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">        
        <div class="bg-white p-6 rounded-xl shadow text-center">
            <h2 class="text-xl font-bold text-gray-800">Total Semua Gedung</h2>
            <p class="text-3xl text-primary-600 font-semibold mt-2">{{ $totalGedung }}</p>
        </div>

        <div class="bg-white p-6 rounded-xl shadow text-center">
            <h2 class="text-xl font-bold text-gray-800">Reservasi Disetujui</h2>
            <p class="text-3xl text-primary-600 font-semibold mt-2">{{ $totalReservasiDisetujui }}</p>
        </div>

        <div class="bg-white p-6 rounded-xl shadow text-center">
            <h2 class="text-xl font-bold text-gray-800">Gedung Yang Ready</h2>
            <p class="text-3xl text-primary-600 font-semibold mt-2">{{ $totalgedungready }}</p>
        </div>
    </div>
</x-filament::page>
