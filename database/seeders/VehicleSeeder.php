<?php

namespace Database\Seeders;

use App\Models\Vehicle;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Vehicle::insert([
            [
                'name' => 'Toyota Hilux',
                'plate_number' => 'B 1234 CD',
                'type' => 'angkutan_barang',
                'ownership' => 'milik_perusahaan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Isuzu Elf',
                'plate_number' => 'B 5678 EF',
                'type' => 'angkutan_orang',
                'ownership' => 'sewa',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
