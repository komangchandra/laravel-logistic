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
            'email' => 'wayan@gmail.com',
            'password' => Hash::make('wayan12345'),
        ]);
        $wayan->assignRole('Direktur');

        // Ferry Juanda - Manager
        $ferry = User::create([
            'name' => 'Ferry Juanda',
            'email' => 'ferryjuanda@gmail.com',
            'password' => Hash::make('ferry12345'),
        ]);
        $ferry->assignRole('Manager');

        // Ananda Wahyu - Manager
        $ananda = User::create([
            'name' => 'Ananda Wahyu',
            'email' => 'anandawahyu@gmail.com',
            'password' => Hash::make('wahyu12345'),
        ]);
        $ananda->assignRole('Manager');

        // Made Chendy - Logistic (User)
        $chendy = User::create([
            'name' => 'Made Chendy',
            'email' => 'logistic@gmail.com',
            'password' => Hash::make('chendy12345'),
        ]);
        $chendy->assignRole('Logistic');

        // Gede Krisna - User
        $gede = User::create([
            'name' => 'Gede Krisna',
            'email' => 'gede@gmail.com',
            'password' => Hash::make('gede12345'),
        ]);
        $gede->assignRole('User');
    }
}
