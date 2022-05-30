<?php

use Database\Seeders\JenisPkbSeeder;
use Database\Seeders\KasirPembayaranSeeder;
use Database\Seeders\KasirSeeder;
use Database\Seeders\KotaPenandatanganSeeder;
use Database\Seeders\PaymentPointSeeder;
use Database\Seeders\UsersSeeder;
use Database\Seeders\PenandatanganSeeder;
use Database\Seeders\WilayahSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersSeeder::class);
        $this->call(KotaPenandatanganSeeder::class);
        $this->call(PenandatanganSeeder::class);
        $this->call(PaymentPointSeeder::class);
        $this->call(WilayahSeeder::class);
        $this->call(JenisPkbSeeder::class);
        $this->call(KasirPembayaranSeeder::class);
        $this->call(KasirSeeder::class);
    }
}
