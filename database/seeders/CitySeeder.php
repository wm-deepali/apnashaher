<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\City;
use App\Models\State;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $gujarat = State::where('name', 'Gujarat')->first();
        City::insert([
            ['state_id' => $gujarat->id, 'name' => 'Ahmedabad'],
            ['state_id' => $gujarat->id, 'name' => 'Surat'],
        ]);
    }
}
