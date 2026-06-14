<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Seed Products Catalog
        Product::create([
            'name' => 'Saco Harina Premium 25kg',
            'stock' => 120,
            'price' => 18500
        ]);

        Product::create([
            'name' => 'Saco Harina Integral 25kg',
            'stock' => 45,
            'price' => 21000
        ]);

        Product::create([
            'name' => 'Saco Harina 000 25kg',
            'stock' => 80,
            'price' => 15000
        ]);

        $this->command->info("Flour products catalog seeded successfully!");

        // 2. Seed Users
        // Admin
        $admin = User::create([
            'name' => 'Administrador Harina',
            'email' => 'admin@harina.com',
            'password' => bcrypt('secret123'),
            'role' => 'admin',
        ]);

        // Client
        $client = User::create([
            'name' => 'Cliente Harina S.A.',
            'email' => 'cliente@harina.com',
            'password' => bcrypt('secret123'),
            'role' => 'client',
        ]);

        // Driver
        $driver = User::create([
            'name' => 'Juan Perez (Repartidor)',
            'email' => 'repartidor@harina.com',
            'password' => bcrypt('secret123'),
            'role' => 'driver',
            'current_latitude' => -33.45000,
            'current_longitude' => -70.64000, // starts at base
        ]);

        $this->command->info("Users seeded successfully!");

        // 3. Issue and Print Tokens
        $adminToken = $admin->createToken('admin-token')->plainTextToken;
        $clientToken = $client->createToken('client-token')->plainTextToken;
        $driverToken = $driver->createToken('driver-token')->plainTextToken;

        $this->command->warn("==================================================");
        $this->command->warn("USE THESE BEARER TOKENS FOR TESTING / RETROFIT:");
        $this->command->info("Admin Token:  $adminToken");
        $this->command->info("Client Token: $clientToken");
        $this->command->info("Driver Token: $driverToken");
        $this->command->warn("==================================================");
    }
}
