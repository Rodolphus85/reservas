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
        $this->call(LocationSeeder::class);
        $this->call(TableSeeder::class);

        User::factory()->create([
            'name' => 'admin',
            'password' => bcrypt('admin'),
            'email' => 'admin@example.com',
            'is_admin' => true
        ]);
    }
}
