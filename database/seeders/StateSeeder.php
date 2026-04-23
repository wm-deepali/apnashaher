<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\State;
use App\Models\Country;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $india = Country::where('name', 'India')->first();
        State::insert([
            ['country_id' => $india->id, 'name' => 'Gujarat'],
            ['country_id' => $india->id, 'name' => 'Maharashtra'],
        ]);
    }
}
