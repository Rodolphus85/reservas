<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('locations')->insert([
           'code' => 'A' 
        ]);
        DB::table('locations')->insert([
           'code' => 'B' 
        ]);
        DB::table('locations')->insert([
           'code' => 'C' 
        ]);
        DB::table('locations')->insert([
           'code' => 'D' 
        ]);
    }
}
