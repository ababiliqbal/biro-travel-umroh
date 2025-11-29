<?php

namespace Database\Seeders;

use App\Models\JamaahProfile;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin Utama',
            'email' => 'admin@barokahtravel.com',
            'password' => Hash::make('admin123#'),
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);


        User::create([
            'name' => 'Budi Marketing',
            'email' => 'marketing@barokahtravel.com',
            'password' => Hash::make('marketing123#'),
            'role' => 'marketing',
        ]);

        User::create([
            'name' => 'Siti Manajer',
            'email' => 'manajer@barokahtravel.com',
            'password' => Hash::make('manajer123#'),
            'role' => 'manager',
        ]);

        $jamaah1 = User::create([
            'name' => 'Ahmad Fauzan',
            'email' => 'ahmadfauzan@gmail.com',
            'password' => Hash::make('ahmadfauzan123#'),
            'role' => 'jamaah',
        ]);

        JamaahProfile::create([
            'user_id' => $jamaah1->id,
            'ktp_number' => '3201010101010001',
            'phone_number' => '081234567890',
            'address' => 'Jl. Merpati No. 10, Jakarta',
        ]);

        User::create([
            'name' => "Lina Kusuma",
            'email' => 'linakusuma@gmail.com',
            'password' => Hash::make('linakusuma123#'),
            'role' => 'jamaah',
        ]);
    }
}
