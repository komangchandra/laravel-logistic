<?php

namespace Database\Seeders;

use App\Models\Unit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $units = [
            ['RD6101', 'Dump Truck Wide Body XCMG', 'GPU Rental KMP', 'Pit Agriya'],
            ['RD6102', 'Dump Truck Wide Body XCMG', 'GPU Rental KMP', 'Pit Agriya'],
            ['RD6103', 'Dump Truck Wide Body XCMG', 'GPU Rental KMP', 'Pit Agriya'],
            ['RD6104', 'Dump Truck Wide Body XCMG', 'GPU Rental KMP', 'Pit Agriya'],
            ['RD6105', 'Dump Truck Wide Body XCMG', 'GPU Rental KMP', 'Pit Agriya'],
            ['RD6106', 'Dump Truck Wide Body XCMG', 'GPU Rental KMP', 'Pit Agriya'],
            ['RD6107', 'Dump Truck Wide Body XCMG', 'GPU Rental KMP', 'Pit Agriya'],
            ['RD6108', 'Dump Truck Wide Body XCMG', 'GPU Rental KMP', 'Pit Agriya'],
        ];

        foreach ($units as $unit) {
            Unit::create([
                'unit_id' => $unit[0],
                'unit_name' => $unit[1],
                'status' => $unit[2],
                'area' => $unit[3],
            ]);
        }
    }
}
