<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Package;
use App\Models\User;
use App\Models\JamaahProfile;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;


class TestingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $facilities = "- Tiket Pesawat PP (Direct)\n- Hotel Bintang 5 (Mekkah/Madinah)\n- Makan 3x Sehari (Menu Indonesia)\n- Visa Umroh\n- Muthawif Berpengalaman\n- Air Zamzam 5 Liter";

        $packages = [
            [
                'name' => 'Umroh Awal Tahun 2026',
                'description' => 'Paket umroh reguler awal tahun dengan cuaca yang sejuk.',
                'price' => 28000000,
                'quota' => 45,
                'payment_due_days' => 30,
                'departure_date' => Carbon::parse('2026-01-15'),
                'departure_location' => 'Jakarta (CGK)',
            ],
            [
                'name' => 'Umroh Ramadhan 2026 (VIP)',
                'description' => 'Nikmati keberkahan bulan suci Ramadhan di Tanah Suci.',
                'price' => 45000000,
                'quota' => 30,
                'payment_due_days' => 45, // Harus lunas lebih awal
                'departure_date' => Carbon::parse('2026-03-10'),
                'departure_location' => 'Jakarta (CGK)',
            ],
            [
                'name' => 'Umroh Syawal (Murah)',
                'description' => 'Paket hemat pasca lebaran.',
                'price' => 24000000,
                'quota' => 50,
                'payment_due_days' => 30,
                'departure_date' => Carbon::parse('2026-05-20'),
                'departure_location' => 'Surabaya (SUB)',
            ],
            [
                'name' => 'Umroh Plus Turki 12 Hari',
                'description' => 'Ziarah ke Istanbul dan Bursa sebelum ke Tanah Suci.',
                'price' => 35000000,
                'quota' => 40,
                'payment_due_days' => 40,
                'departure_date' => Carbon::parse('2026-02-10'),
                'departure_location' => 'Jakarta (CGK)',
            ],
            [
                'name' => 'Umroh Akhir Tahun 2025',
                'description' => 'Tutup tahun dengan ibadah.',
                'price' => 32000000,
                'quota' => 45,
                'payment_due_days' => 30,
                'departure_date' => Carbon::parse('2025-12-25'),
                'departure_location' => 'Jakarta (CGK)',
            ],
            // --- DATA UNTUK TESTING LOGIKA ---
            [
                'name' => '[TEST] Paket Mepet (Jatuh Tempo Besok)',
                'description' => 'Paket ini berangkat sebentar lagi. Cek logika overdue.',
                'price' => 26000000,
                'quota' => 20,
                'payment_due_days' => 30,
                'departure_date' => now()->addDays(31), // Jatuh tempo = Besok (H-30)
                'departure_location' => 'Jakarta (CGK)',
            ],
            [
                'name' => '[TEST] Paket Overdue (Sudah Lewat Bayar)',
                'description' => 'Harusnya tidak bisa bayar lagi jika daftar sekarang.',
                'price' => 26000000,
                'quota' => 20,
                'payment_due_days' => 30,
                'departure_date' => now()->addDays(10), // Jatuh tempo sudah lewat 20 hari lalu
                'departure_location' => 'Jakarta (CGK)',
            ],
            [
                'name' => '[TEST] Paket Sisa 1 Kursi',
                'description' => 'Cek apakah sistem locking bekerja saat 2 orang daftar bareng.',
                'price' => 25000000,
                'quota' => 1, // Kuota kritis
                'payment_due_days' => 30,
                'departure_date' => Carbon::parse('2026-06-01'),
                'departure_location' => 'Medan (KNO)',
            ],
            [
                'name' => '[TEST] Paket Full Booked',
                'description' => 'Harusnya tidak bisa didaftar (Tombol disabled).',
                'price' => 25000000,
                'quota' => 0, // Sengaja 0
                'payment_due_days' => 30,
                'departure_date' => Carbon::parse('2026-07-01'),
                'departure_location' => 'Jakarta (CGK)',
            ],
            [
                'name' => '[TEST] Paket Lampau (History)',
                'description' => 'Paket yang sudah berangkat tahun lalu.',
                'price' => 22000000,
                'quota' => 45,
                'payment_due_days' => 30,
                'departure_date' => Carbon::parse('2023-01-01'),
                'departure_location' => 'Jakarta (CGK)',
            ],
        ];

        foreach ($packages as $pkg) {
            Package::create(array_merge($pkg, [
                'cover_image_path' => null,
                'facilities' => $facilities
            ]));
        }

        $jamaahs = [
            [
                'name' => 'Ahmad Jemaah',
                'email' => 'ahmad@test.com',
                'phone' => '081234567890',
                'ktp' => '3171234567890001',
            ],
            [
                'name' => 'Budi Santoso',
                'email' => 'budi@test.com',
                'phone' => '081234567891',
                'ktp' => '3171234567890002',
            ],
            [
                'name' => 'Citra Lestari',
                'email' => 'citra@test.com',
                'phone' => '081234567892',
                'ktp' => '3171234567890003',
            ],
            [
                'name' => 'Dewi Sartika',
                'email' => 'dewi@test.com',
                'phone' => '081234567893',
                'ktp' => '3171234567890004',
            ],
            [
                'name' => 'Eko Kurniawan',
                'email' => 'eko@test.com',
                'phone' => null,
                'ktp' => null,
            ],
        ];

        foreach ($jamaahs as $j) {
            if (User::where('email', $j['email'])->exists()) continue;

            $user = User::create([
                'name' => $j['name'],
                'email' => $j['email'],
                'password' => Hash::make('password'),
                'role' => 'jamaah',
            ]);

            if ($j['ktp']) {
                JamaahProfile::create([
                    'user_id' => $user->id,
                    'ktp_number' => $j['ktp'],
                    'passport_number' => 'X' . rand(1000000, 9999999),
                    'phone_number' => $j['phone'],
                    'address' => 'Jl. Contoh No. ' . rand(1, 100) . ', Jakarta',
                    'date_of_birth' => '1980-01-01',
                ]);
            } else {
            }
        }
    }
}
