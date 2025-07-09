<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-800">Form Pemesanan Kendaraan</h2>
    </x-slot>

    <div class="py-6">
        <div class="w-full px-4 md:px-6 lg:px-12 xl:px-20">

            <div class="bg-white shadow-lg rounded-xl p-6 md:p-8 lg:p-10">

                {{-- Error Alert --}}
                @if ($errors->any())
                    <div class="mb-6 bg-red-100 text-red-800 p-4 rounded-md">
                        <ul class="list-disc pl-5 text-sm">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('reservations.store') }}" class="space-y-8">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                        {{-- Kendaraan --}}
                        <div class="col-span-1">
                            <label for="vehicle_id" class="block text-sm font-medium text-gray-700 mb-1">Kendaraan</label>
                            <select name="vehicle_id" id="vehicle_id"
                                class="form-select w-full border-gray-300 rounded-md">
                                <option value="">-- Pilih Kendaraan --</option>
                                @foreach ($vehicles as $vehicle)
                                    <option value="{{ $vehicle->id }}" {{ old('vehicle_id') == $vehicle->id ? 'selected' : '' }}>
                                        {{ $vehicle->name }} ({{ $vehicle->plate_number }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Driver --}}
                        <div class="col-span-1">
                            <label for="driver_id" class="block text-sm font-medium text-gray-700 mb-1">Driver (Opsional)</label>
                            <select name="driver_id" id="driver_id"
                                class="form-select w-full border-gray-300 rounded-md">
                                <option value="">-- Pilih Driver --</option>
                                @foreach ($drivers as $driver)
                                    <option value="{{ $driver->id }}" {{ old('driver_id') == $driver->id ? 'selected' : '' }}>
                                        {{ $driver->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Approver 1 --}}
                        <div class="col-span-1">
                            <label for="approver_1_id" class="block text-sm font-medium text-gray-700 mb-1">Approver Level 1</label>
                            <select name="approver_1_id" id="approver_1_id"
                                class="form-select w-full border-gray-300 rounded-md">
                                <option value="">-- Pilih Approver 1 --</option>
                                @foreach ($approvers1 as $approver)
                                    <option value="{{ $approver->id }}" {{ old('approver_1_id') == $approver->id ? 'selected' : '' }}>
                                        {{ $approver->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Approver 2 --}}
                        <div class="col-span-1">
                            <label for="approver_2_id" class="block text-sm font-medium text-gray-700 mb-1">Approver Level 2</label>
                            <select name="approver_2_id" id="approver_2_id"
                                class="form-select w-full border-gray-300 rounded-md">
                                <option value="">-- Pilih Approver 2 --</option>
                                @foreach ($approvers2 as $approver)
                                    <option value="{{ $approver->id }}" {{ old('approver_2_id') == $approver->id ? 'selected' : '' }}>
                                        {{ $approver->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Start Time --}}
                        <div class="col-span-1">
                            <label for="start_time" class="block text-sm font-medium text-gray-700 mb-1">Waktu Mulai</label>
                            <input type="datetime-local" name="start_time" id="start_time"
                                class="form-input w-full border-gray-300 rounded-md"
                                value="{{ old('start_time') }}">
                        </div>

                        {{-- End Time --}}
                        <div class="col-span-1">
                            <label for="end_time" class="block text-sm font-medium text-gray-700 mb-1">Waktu Selesai</label>
                            <input type="datetime-local" name="end_time" id="end_time"
                                class="form-input w-full border-gray-300 rounded-md"
                                value="{{ old('end_time') }}">
                        </div>
                    </div>

                    {{-- Purpose --}}
                    <div class="col-span-full">
                        <label for="purpose" class="block text-sm font-medium text-gray-700 mb-1">Keperluan</label>
                        <textarea name="purpose" id="purpose" rows="4"
                            class="form-textarea w-full border-gray-300 rounded-md"
                            placeholder="Tuliskan keperluan pemakaian kendaraan...">{{ old('purpose') }}</textarea>
                    </div>

                    <div class="pt-4 text-right">
                        <button type="submit"
                            class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-all">
                            Simpan Pemesanan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
