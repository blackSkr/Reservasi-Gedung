<div class="bg-white dark:bg-gray-800 p-6 rounded shadow">
    <h3 class="text-lg font-semibold mb-4">Reservasi 6 Bulan Terakhir</h3>

    {{-- Fix ukuran grafik --}}
    <div class="relative h-[280px]">
        <canvas id="chartReservasi" class="!w-full !h-full"></canvas>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('chartReservasi').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: @json($labels),
            datasets: [{
                label: 'Jumlah Reservasi',
                data: @json($data),
                backgroundColor: 'rgba(59, 130, 246, 0.5)',
                borderColor: 'rgba(59, 130, 246, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false, // ✅ Ini penting agar tinggi dari div diikuti
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                }
            }
        }
    });
</script>
@endpush
