<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">Log Aktivitas</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded p-4 overflow-x-auto">
                <table class="min-w-full text-sm table-auto whitespace-nowrap">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-2 text-left">Waktu</th>
                            <th class="px-4 py-2 text-left">User</th>
                            <th class="px-4 py-2 text-left">Aksi</th>
                            <th class="px-4 py-2 text-left">Target</th>
                            <th class="px-4 py-2 text-left">Deskripsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($logs as $log)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="px-4 py-2">{{ $log->created_at->format('d M Y H:i') }}</td>
                                <td class="px-4 py-2">{{ $log->user_name ?? 'N/A' }}</td>
                                <td class="px-4 py-2">{{ $log->action }}</td>
                                <td class="px-4 py-2">{{ $log->target_type }} (ID: {{ $log->target_id }})</td>
                                <td class="px-4 py-2">{{ $log->description }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $logs->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
