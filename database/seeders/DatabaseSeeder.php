<?php

use Database\Seeders\BidangSeeder;
use Database\Seeders\JabatanTimSeeder;
use Database\Seeders\JenisPenugasanSeeder;
use Database\Seeders\KategoriPenugasanSeeder;
use Database\Seeders\PangkatSeeder;
use Database\Seeders\SkpdSeeder;
use Database\Seeders\TanggalLiburSeeder;
use Database\Seeders\UsersSeeder;
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
        $this->call(BidangSeeder::class);
        $this->call(PangkatSeeder::class);
        $this->call(UsersSeeder::class);
        $this->call(JenisPenugasanSeeder::class);
        $this->call(KategoriPenugasanSeeder::class);
        $this->call(SkpdSeeder::class);
        $this->call(JabatanTimSeeder::class);
        $this->call(TanggalLiburSeeder::class);
    }
}
