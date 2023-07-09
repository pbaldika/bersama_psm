<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InvestorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('investors')->insert([
            [
                'id' => 3,
                'user_id' => 7,
                'created_at' => '2023-06-20 20:51:46',
                'updated_at' => '2023-06-20 21:53:38',
                'identity_type' => 'passport',
                'identity_number' => '290302',
                'identity_photo' => '202306210553_contoh NIB.jpg',
                'identity_selfie' => '202306210553_contoh NIB.jpg',
            ],
            [
                'id' => 4,
                'user_id' => 17,
                'created_at' => '2023-06-20 22:20:56',
                'updated_at' => '2023-06-20 22:20:56',
                'identity_type' => 'ktp',
                'identity_number' => '1231231231231',
                'identity_photo' => '202306210620_contoh selfie ktp.png.webp',
                'identity_selfie' => '202306210620_contoh selfie ktp.png.webp',
            ],
        ]);
    }
}
