<?php

namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Laravel\Prompts\Table;

class TableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $locations = Location::all();
        $tableCount = 10;

        $usedNumbers = [];

        for ($i = 1; $i <= $tableCount; $i++) {

            $location = $locations->random()->id;

            do {
                $number = rand(1, 20);
            } while (isset($usedNumbers[$location][$number]));

            $usedNumbers[$location][$number] = true;

            DB::table('tables')->insert([
                'location_id' => $location,
                'number' => $number,
                'guest_count' => rand(2, 8)
            ]);
        }
    }
}
