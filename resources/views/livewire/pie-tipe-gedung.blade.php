<div class="bg-white dark:bg-gray-800 p-4 rounded shadow mt-6">
    <h3 class="text-base font-semibold mb-3">Distribusi Tipe Gedung</h3>
    <div class="relative h-[200px]">
        <canvas id="chartPieTipe" class="!w-full !h-full"></canvas>
    </div>
</div>

@push('scripts')
<script>
    const ctxPie = document.getElementById('chartPieTipe').getContext('2d');
    new Chart(ctxPie, {
        type: 'pie',
        data: {
            labels: @json($labels),
            datasets: [{
                label: 'Jumlah Gedung',
                data: @json($data),
                backgroundColor: [
                    'rgba(255, 99, 132, 0.5)',
                    'rgba(54, 162, 235, 0.5)',
                    'rgba(255, 206, 86, 0.5)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });
</script>
@endpush
