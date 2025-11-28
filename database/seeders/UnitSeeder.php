<?php

namespace Database\Seeders;

use App\Models\Unit;
use Illuminate\Database\Seeder;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $units = [
            ['0006601332', 'RD6101', 'Dump Truck Wide Body XCMG', 'GPU Rental KMP', 'Pit Agriya', 'OB Removal', true],
            ['0006601327', 'RD6102', 'Dump Truck Wide Body XCMG', 'GPU Rental KMP', 'Pit Agriya', 'OB Removal', true],
            ['0006601302', 'RD6103', 'Dump Truck Wide Body XCMG', 'GPU Rental KMP', 'Pit Agriya', 'OB Removal', true],
            ['0006601297', 'RD6104', 'Dump Truck Wide Body XCMG', 'GPU Rental KMP', 'Pit Agriya', 'OB Removal', true],
            ['0006601272', 'RD6105', 'Dump Truck Wide Body XCMG', 'GPU Rental KMP', 'Pit Agriya', 'OB Removal', true],
            ['85492176', 'RD6106', 'Dump Truck Wide Body XCMG', 'GPU Rental KMP', 'Pit Agriya', 'OB Removal', true],
            ['29645013', 'RD6107', 'Dump Truck Wide Body XCMG', 'GPU Rental KMP', 'Pit Agriya', 'OB Removal', true],
            ['73809641', 'RD6108', 'Dump Truck Wide Body XCMG', 'GPU Rental KMP', 'Pit Agriya', 'OB Removal', true],
        ];

        foreach ($units as $unit) {
            Unit::create([
                'unit_id' => $unit[0],
                'nomor_lambung' => $unit[1],
                'unit_name' => $unit[2],
                'status' => $unit[3],
                'area' => $unit[4],
                'activity' => $unit[5],
            ]);
        }
    }
}
