<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Komang Chandra - Super Admin
        $komang = User::create([
            'name' => 'Komang Chandra Winata',
            'email' => 'komangchandraaa1@gmail.com',
            'password' => Hash::make('Empire8855!'),
        ]);
        $komang->assignRole('Super Admin');

        // Wayan Sujasman - Direktur
        $wayan = User::create([
            'name' => 'Wayan Sujasman',
            'email' => 'wayans@atlas-coal.co.id',
            'password' => Hash::make('@Kemang43'),
        ]);
        $wayan->assignRole('Direktur');

        // Ferry Juanda - Manager
        $ferry = User::create([
            'name' => 'Ferry Juanda',
            'email' => 'ferry.juanda@gorbyputrautama.com',
            'password' => Hash::make('@Kemang43'),
        ]);
        $ferry->assignRole('Manager');

        // Ananda Wahyu - Manager (KTT)
        $ananda = User::create([
            'name' => 'Ananda Wahyu',
            'email' => 'ananda.wahyu@gorbyputrautama.com',
            'password' => Hash::make('@Kemang43'),
        ]);
        $ananda->assignRole('Manager');

        // Arif Rahman - Manager (KTT)
        $arif = User::create([
            'name' => 'Arif Rahman',
            'email' => 'mineplan@gorbyputrautama.com',
            'password' => Hash::make('@Kemang43'),
        ]);
        $arif->assignRole('Manager');

        // Johan Barus - Eng
        $johan = User::create([
            'name' => 'Johan P Barus',
            'email' => '02_mineplan@gorbyputrautama.com',
            'password' => Hash::make('@Kemang43'),
        ]);
        $johan->assignRole('User');
        
        // Rafli - Eng
        $rafli = User::create([
            'name' => 'Rafli Ronaldi',
            'email' => '03_mineplan@gorbyputrautama.com',
            'password' => Hash::make('@Kemang43'),
        ]);
        $rafli->assignRole('User');
        
        // Admin - Eng
        $admineng = User::create([
            'name' => 'Admin Engineering',
            'email' => 'admin.engineering@gorbyputrautama.com',
            'password' => Hash::make('@Kemang43'),
        ]);
        $admineng->assignRole('User');
        
        // Logistic - Eng
        $logistik = User::create([
            'name' => 'Purchasing Officer',
            'email' => 'logistic@gorbyputrautama.com',
            'password' => Hash::make('@Kemang43'),
        ]);
        $logistik->assignRole('Logistic');
    }
}