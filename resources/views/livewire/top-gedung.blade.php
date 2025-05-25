<div class="bg-white dark:bg-gray-800 p-6 rounded shadow mt-6">
    <h3 class="text-lg font-semibold mb-4">Top 3 Gedung Terfavorit</h3>

    <ul class="space-y-2">
        @foreach ($topGedung as $item)
            <li class="flex justify-between">
                <span>{{ $item->nama_gedung }}</span>
                <span class="font-bold">{{ $item->total }}x</span>
            </li>
        @endforeach
    </ul>
</div>
