<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            VendorSeeder::class,
        ]);

        $adminRole = \App\Models\Role::where('slug', 'admin')->first();

        User::factory()->create([
            'name' => 'System Admin',
            'email' => 'admin@multiven.com',
            'role_id' => $adminRole->id,
            'status' => 'active',
        ]);
    }
}
