<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">Daftar Pemesanan Kendaraan</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="mb-4">
                <a href="{{ route('reservations.create') }}"
                   class="inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                    + Tambah Pemesanan
                </a>
            </div>

            <div class="bg-white shadow-md rounded p-4 overflow-x-auto">
                <table class="min-w-[900px] w-full border text-sm text-left">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="border px-4 py-2">No</th>
                            <th class="border px-4 py-2">Kendaraan</th>
                            <th class="border px-4 py-2">Plat</th>
                            <th class="border px-4 py-2">Pemesan</th>
                            <th class="border px-4 py-2">Waktu</th>
                            <th class="border px-4 py-2">Status</th>
                            <th class="border px-4 py-2">Approver 1</th>
                            <th class="border px-4 py-2">Approver 2</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($reservations as $index => $item)
                            <tr class="hover:bg-gray-50">
                                <td class="border px-4 py-2">{{ $index + 1 }}</td>
                                <td class="border px-4 py-2">{{ $item->vehicle->name ?? '-' }}</td>
                                <td class="border px-4 py-2">{{ $item->vehicle->plate_number ?? '-' }}</td>
                                <td class="border px-4 py-2">{{ $item->user->name ?? '-' }}</td>
                                <td class="border px-4 py-2 whitespace-nowrap">
                                    {{ \Carbon\Carbon::parse($item->start_time)->format('d M Y H:i') }}<br>
                                    s.d. {{ \Carbon\Carbon::parse($item->end_time)->format('d M Y H:i') }}
                                </td>
                                <td class="border px-4 py-2">
                                    <span class="inline-block px-2 py-1 text-xs font-semibold rounded
                                        @if($item->status === 'pending') bg-yellow-100 text-yellow-800
                                        @elseif($item->status === 'approved_lvl1') bg-blue-100 text-blue-800
                                        @elseif($item->status === 'approved_lvl2') bg-green-100 text-green-800
                                        @else bg-red-100 text-red-800 @endif">
                                        {{ ucfirst(str_replace('_', ' ', $item->status)) }}
                                    </span>
                                </td>
                                <td class="border px-4 py-2">{{ $item->approver1->name ?? '-' }}</td>
                                <td class="border px-4 py-2">{{ $item->approver2->name ?? '-' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-4 text-gray-500">Belum ada pemesanan kendaraan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>
