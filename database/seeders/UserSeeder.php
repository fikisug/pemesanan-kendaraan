<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Buat roles
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $approver1Role = Role::firstOrCreate(['name' => 'approver_1']);
        $approver2Role = Role::firstOrCreate(['name' => 'approver_2']);
        $driverRole = Role::firstOrCreate(['name' => 'driver']);

        // Buat user admin
        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            ['name' => 'Admin', 'password' => bcrypt('password')]
        );
        $admin->assignRole($adminRole);

        // Buat user approver level 1
        $approver1 = User::firstOrCreate(
            ['email' => 'approver1@example.com'],
            ['name' => 'Approver 1', 'password' => bcrypt('password')]
        );
        $approver1->assignRole($approver1Role);

        // Buat user approver level 2
        $approver2 = User::firstOrCreate(
            ['email' => 'approver2@example.com'],
            ['name' => 'Approver 2', 'password' => bcrypt('password')]
        );
        $approver2->assignRole($approver2Role);

        $driver = User::firstOrCreate(
            ['email' => 'driver@example.com'],
            ['name' => 'Driver 1', 'password' => bcrypt('password')]
        );
        $driver->assignRole($driverRole);
    }
}
