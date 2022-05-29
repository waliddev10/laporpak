<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        return User::create([
            'nama' => 'Muhammad Donny Dermawan, A.Md.Pnl.',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('@dmin'),
            'nip' => '199911052022011002',
            'jabatan' => 'Pengelola Layanan Operasional',
            'email_verified_at' => Carbon::now()->format('Y-m-d'),
            'role' => 'admin',
            'remember_token' => null,
        ]);
    }
}
