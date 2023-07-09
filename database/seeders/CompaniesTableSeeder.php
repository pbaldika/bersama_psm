<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompaniesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('companies')->insert([
            [
                'id' => 1,
                'user_id' => 12,
                'created_at' => '2023-06-20 20:32:29',
                'updated_at' => '2023-06-20 20:32:29',
                'registration_type' => 'NIB',
                'registration_photo' => '202306210432_contoh NIB.jpg',
                'registration_number' => '12212121',
            ],
            [
                'id' => 2,
                'user_id' => 4,
                'created_at' => '2023-06-20 20:36:15',
                'updated_at' => '2023-06-20 20:36:15',
                'registration_type' => 'NIB',
                'registration_photo' => '202306210436_contoh NIB copy.jpg',
                'registration_number' => '12212121',
            ],
            [
                'id' => 3,
                'user_id' => 11,
                'created_at' => '2023-06-20 20:38:55',
                'updated_at' => '2023-06-20 22:18:49',
                'registration_type' => 'NIB',
                'registration_photo' => '202306210618_contoh NIB.jpg',
                'registration_number' => '12212121',
            ],
            [
                'id' => 4,
                'user_id' => 13,
                'created_at' => '2023-06-20 21:59:52',
                'updated_at' => '2023-06-20 22:19:36',
                'registration_type' => 'NIB',
                'registration_photo' => '202306210619_contoh NIB.jpg',
                'registration_number' => '290302241',
            ],
            // Add more entries if needed
        ]);
    }
}
