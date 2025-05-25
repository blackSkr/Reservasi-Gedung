<div class="bg-white dark:bg-gray-800 p-6 rounded shadow mt-6">
    <h3 class="text-lg font-semibold mb-4">Reservasi Terbaru</h3>

    <table class="w-full text-left border-collapse">
        <thead>
            <tr class="text-sm text-gray-600 dark:text-gray-300">
                <th class="py-2">Gedung</th>
                <th class="py-2">User</th>
                <th class="py-2">Tanggal</th>
                <th class="py-2">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reservasi as $item)
                <tr class="border-t text-sm text-gray-800 dark:text-gray-100">
                    <td class="py-2">{{ $item->gedung->nama_gedung ?? '-' }}</td>
                    <td class="py-2">{{ $item->user->name ?? '-' }}</td>
                    <td class="py-2">{{ $item->waktu_reservasi->format('d M Y') }}</td>
                    <td class="py-2">{{ ucfirst($item->status) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
