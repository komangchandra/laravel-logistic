<?php

namespace Database\Seeders;

use App\Models\Station;
use Illuminate\Database\Seeder;

class StationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Station::create([
            'station_name' => 'Fuel Station',
            'flow_meter' => 0
        ]);
        Station::create([
            'station_name' => 'FTM 16KL - GPU',
            'flow_meter' => 0
        ]);
        Station::create([
            'station_name' => 'FTM1001  (10 KL)',
            'flow_meter' => 0
        ]);
        Station::create([
            'station_name' => 'FT TJP 01 (16 KL)',
            'flow_meter' => 0
        ]);
        Station::create([
            'station_name' => 'FT TJP 02 (16 KL)',
            'flow_meter' => 0
        ]);
    }
}
