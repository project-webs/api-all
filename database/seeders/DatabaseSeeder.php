<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Admin Portal',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
        ]);

        $budi = \App\Models\Member::create([
            'name' => 'Budi Santoso',
            'member_number' => 'PTM-BI-001',
            'phone' => '081234567890',
            'address' => 'Blok F No. 12, Perumahan Batan Indah',
            'status' => 'active',
            'joined_at' => '2024-01-15',
        ]);

        $joko = \App\Models\Member::create([
            'name' => 'Joko Prasetyo',
            'member_number' => 'PTM-BI-002',
            'phone' => '081234567891',
            'address' => 'Blok H No. 5, Perumahan Batan Indah',
            'status' => 'active',
            'joined_at' => '2024-02-10',
        ]);

        $agus = \App\Models\Member::create([
            'name' => 'Agus Hermawan',
            'member_number' => 'PTM-BI-003',
            'phone' => '081234567892',
            'address' => 'Blok A No. 19, Perumahan Batan Indah',
            'status' => 'inactive',
            'joined_at' => '2023-11-20',
        ]);

        // Seed contributions
        \App\Models\Contribution::create([
            'member_id' => $budi->id,
            'period' => '2026-05-01',
            'amount' => 20000,
            'payment_date' => '2026-05-05',
            'status' => 'paid',
            'notes' => 'Transfer via Bank Mandiri',
        ]);

        \App\Models\Contribution::create([
            'member_id' => $joko->id,
            'period' => '2026-05-01',
            'amount' => 20000,
            'payment_date' => '2026-05-06',
            'status' => 'paid',
            'notes' => 'Bayar tunai (cash)',
        ]);

        \App\Models\Contribution::create([
            'member_id' => $agus->id,
            'period' => '2026-05-01',
            'amount' => 20000,
            'payment_date' => null,
            'status' => 'unpaid',
            'notes' => 'Belum bayar karena status anggota tidak aktif',
        ]);

        // Seed transactions
        \App\Models\Transaction::create([
            'date' => '2026-05-05',
            'type' => 'income',
            'amount' => 20000,
            'description' => 'Iuran Bulanan Mei 2026 - Budi Santoso',
            'notes' => 'Otomatis/Manual via Kasir',
        ]);

        \App\Models\Transaction::create([
            'date' => '2026-05-06',
            'type' => 'income',
            'amount' => 20000,
            'description' => 'Iuran Bulanan Mei 2026 - Joko Prasetyo',
            'notes' => 'Bayar tunai',
        ]);

        \App\Models\Transaction::create([
            'date' => '2026-05-10',
            'type' => 'income',
            'amount' => 250000,
            'description' => 'Donasi Sukarela Warga Batan Indah',
            'notes' => 'Hamba Allah',
        ]);

        \App\Models\Transaction::create([
            'date' => '2026-05-12',
            'type' => 'expense',
            'amount' => 30000,
            'description' => 'Pembelian Bola Pingpong 2 Dus',
            'notes' => 'Merek Butterfly 3-Star',
        ]);

        \App\Models\Transaction::create([
            'date' => '2026-05-15',
            'type' => 'expense',
            'amount' => 75000,
            'description' => 'Pembelian Net Meja Pingpong Baru',
            'notes' => 'Toko Olahraga Jaya',
        ]);
    }
}
