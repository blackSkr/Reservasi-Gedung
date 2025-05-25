@php
    use App\Models\Reservasi;

    $pendingItems = Reservasi::where('status', 'pending')->latest()->take(5)->get();
    $paidItems = Reservasi::where('status', 'Sudah Membayar')->latest()->take(5)->get();
    $totalBadge = $pendingItems->count() + $paidItems->count();
@endphp


<x-filament::dropdown placement="bottom-end" class="mr-4">
    <x-slot name="trigger">
        <button class="relative focus:outline-none">
            <x-heroicon-o-bell class="w-6 h-6 text-gray-600 hover:text-primary-600 transition" />
            @if ($totalBadge > 0)
                <span class="absolute -top-1 -right-1 inline-flex items-center justify-center px-1.5 py-0.5 text-xs font-bold text-white bg-blue-600 rounded-full shadow">
                    {{ $totalBadge }}
                </span>
            @endif
        </button>
    </x-slot>


    <div class="max-h-96 overflow-y-auto w-80 bg-white shadow-xl rounded-lg">
        {{-- Section: Pending --}}
        <div class="p-4 border-b">
            <h3 class="text-sm font-semibold text-gray-700">Reservasi Baru</h3>
        </div>

        <ul class="divide-y divide-gray-100">
            @forelse ($pendingItems as $item)
                <a href="{{ route('filament.admin.resources.reservasis.view', ['record' => $item->id]) }}">
                    <li class="px-4 py-3 hover:bg-gray-50 transition cursor-pointer">
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-700">
                                <span class="font-medium">{{ $item->user->name ?? 'User' }}</span>
                                mengajukan reservasi.
                            </span>
                            <span class="text-xs px-2 py-1 bg-yellow-100 text-yellow-800 rounded-full font-medium">
                                Pending
                            </span>
                        </div>
                        <div class="text-xs text-gray-500 mt-1">
                            {{ $item->created_at->diffForHumans() }}
                        </div>
                    </li>
                </a>
            @empty
                <li class="px-4 py-4 text-center text-sm text-gray-500">
                    Tidak ada reservasi pending.
                </li>
            @endforelse
        </ul>

        {{-- Spacer --}}
        <div class="py-2 border-t border-b bg-gray-50 text-center text-xs text-gray-400">
            Status Lain
        </div>

        {{-- Section: Sudah Bayar --}}
        <div class="p-4 border-b">
            <h3 class="text-sm font-semibold text-gray-700">Reservasi Dibayar</h3>
        </div>

        <ul class="divide-y divide-gray-100">
            @forelse ($paidItems as $item)
                <a href="{{ route('filament.admin.resources.reservasis.view', ['record' => $item->id]) }}">
                    <li class="px-4 py-3 hover:bg-gray-50 transition cursor-pointer">
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-700">
                                <span class="font-medium">{{ $item->user->name ?? 'User' }}</span>
                                sudah membayar reservasi.
                            </span>
                            <span class="text-xs px-2 py-1 bg-green-100 text-green-800 rounded-full font-medium">
                                Dibayar
                            </span>
                        </div>
                        <div class="text-xs text-gray-500 mt-1">
                            {{ $item->updated_at->diffForHumans() }}
                        </div>
                    </li>
                </a>
            @empty
                <li class="px-4 py-4 text-center text-sm text-gray-500">
                    Belum ada yang membayar.
                </li>
            @endforelse
        </ul>

        <div class="p-2 border-t text-sm text-center">
            <a href="{{ route('filament.admin.resources.reservasis.index') }}" class="text-primary-600 hover:underline">
                Lihat semua reservasi
            </a>
        </div>
    </div>
</x-filament::dropdown>
