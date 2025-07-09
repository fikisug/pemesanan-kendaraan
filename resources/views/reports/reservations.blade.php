<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">Laporan Pemesanan Kendaraan</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
            <form method="GET" class="flex flex-col sm:flex-row sm:flex-wrap gap-4 mb-6">
                <div class="flex-1 min-w-[200px]">
                    <label class="block text-sm font-medium text-gray-700">Mulai</label>
                    <input type="date" name="start_date" value="{{ request('start_date') }}"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" />
                </div>
                <div class="flex-1 min-w-[200px]">
                    <label class="block text-sm font-medium text-gray-700">Sampai</label>
                    <input type="date" name="end_date" value="{{ request('end_date') }}"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" />
                </div>
                <div class="flex items-end gap-2">
                    <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Tampilkan</button>

                    @if ($start && $end)
                        <a href="{{ route('reports.reservations.export', ['start_date' => $start, 'end_date' => $end]) }}"
                            class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">Export Excel</a>
                    @endif
                </div>
            </form>

            @if ($start && $end)
                <div class="bg-white rounded-lg shadow-md p-4 overflow-x-auto">
                    <table class="min-w-full text-sm text-left border border-gray-200">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-3 py-2 border-b border-gray-200">Kendaraan</th>
                                <th class="px-3 py-2 border-b border-gray-200">Pemesan</th>
                                <th class="px-3 py-2 border-b border-gray-200">Waktu</th>
                                <th class="px-3 py-2 border-b border-gray-200">Keperluan</th>
                                <th class="px-3 py-2 border-b border-gray-200">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($reservations as $r)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-3 py-2 border-b border-gray-200">{{ $r->vehicle->name ?? '-' }}</td>
                                    <td class="px-3 py-2 border-b border-gray-200">{{ $r->user->name ?? '-' }}</td>
                                    <td class="px-3 py-2 border-b border-gray-200">
                                        {{ \Carbon\Carbon::parse($r->start_time)->format('d M Y') }}
                                    </td>
                                    <td class="px-3 py-2 border-b border-gray-200">{{ $r->purpose }}</td>
                                    <td class="px-3 py-2 border-b border-gray-200 capitalize">{{ $r->status }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4 text-gray-500">Data tidak tersedia</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center text-gray-500 mt-6">
                    Silakan pilih rentang tanggal terlebih dahulu untuk melihat laporan.
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
