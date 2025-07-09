<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-semibold text-gray-800">Persetujuan Pemesanan</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-800 rounded-md">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white shadow-md rounded-lg overflow-x-auto">
                <table class="min-w-[900px] w-full text-sm text-left text-gray-700 relative">
                    <thead class="bg-gray-100 border-b">
                        <tr>
                            <th class="px-4 py-3">Kendaraan</th>
                            <th class="px-4 py-3">Pemesan</th>
                            <th class="px-4 py-3">Waktu</th>
                            <th class="px-4 py-3">Keperluan</th>
                            <th class="px-4 py-3 sticky right-0 bg-gray-100 z-20">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($reservations as $reservation)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="px-4 py-3 whitespace-normal">
                                    {{ $reservation->vehicle->name ?? '-' }}<br>
                                    <span class="text-xs text-gray-500">
                                        {{ $reservation->vehicle->plate_number ?? '' }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 whitespace-normal">
                                    {{ $reservation->user->name ?? '-' }}
                                </td>
                                <td class="px-4 py-3 whitespace-nowrap">
                                    {{ \Carbon\Carbon::parse($reservation->start_time)->format('d M Y H:i') }}
                                    <span class="inline-block md:hidden">→</span>
                                    {{ \Carbon\Carbon::parse($reservation->end_time)->format('d M Y H:i') }}
                                </td>
                                <td class="px-4 py-3 whitespace-normal">
                                    {{ $reservation->purpose }}
                                </td>
                                <td class="px-4 py-3 sticky right-0 bg-white z-10">
                                    <div class="flex flex-col sm:flex-row gap-2">
                                        <form method="POST" action="{{ route('approvals.update', $reservation->id) }}">
                                            @csrf @method('PATCH')
                                            <input type="hidden" name="action" value="approve">
                                            <button type="submit"
                                                class="w-full sm:w-auto px-3 py-1 bg-green-600 text-white text-xs rounded hover:bg-green-700">
                                                Setujui
                                            </button>
                                        </form>

                                        <form method="POST" action="{{ route('approvals.update', $reservation->id) }}">
                                            @csrf @method('PATCH')
                                            <input type="hidden" name="action" value="reject">
                                            <button type="submit"
                                                class="w-full sm:w-auto px-3 py-1 bg-red-600 text-white text-xs rounded hover:bg-red-700">
                                                Tolak
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center px-4 py-6 text-gray-500">
                                    Tidak ada pemesanan yang perlu disetujui.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>
