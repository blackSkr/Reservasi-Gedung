{{-- Grid 2 Kolom: Grafik Pendapatan (kiri) & Konten lain (kanan) --}}
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mt-6">
    
    {{-- KIRI: Grafik Pendapatan --}}
    <div class="bg-white dark:bg-gray-800 p-6 rounded shadow lg:col-span-1">
        <h3 class="text-lg font-semibold mb-4">Pendapatan 6 Bulan Terakhir</h3>
        <div class="relative h-[220px]">
            <canvas id="chartPendapatan" class="!w-full !h-full"></canvas>
        </div>
    </div>

</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctxPendapatan = document.getElementById('chartPendapatan').getContext('2d');
    new Chart(ctxPendapatan, {
        type: 'line',
        data: {
            labels: @json($labels),
            datasets: [{
                label: 'Pendapatan (IDR)',
                data: @json($data),
                fill: true,
                borderColor: 'rgb(75, 192, 192)',
                tension: 0.3
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
@endpush
