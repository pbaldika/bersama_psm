<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FundingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('fundings')->insert([
            [
                'id' => 1,
                'created_at' => '2023-06-12 08:09:45',
                'updated_at' => '2023-06-12 20:26:18',
                'fund_required' => null,
                'start_date' => '2023-06-09',
                'end_date' => '2023-06-08',
                'customer_id' => 4,
                'customerName' => 'old company',
                'customerOrder' => 'cat yang banyak',
                'description' => 'yang banyak ya tolong',
                'status' => 'active',
                'company_registration_number' => null,
                'order_photo' => null,
                'additional_info' => null,
            ],
            [
                'id' => 2,
                'created_at' => '2023-06-28 00:10:24',
                'updated_at' => '2023-06-28 00:59:45',
                'fund_required' => null,
                'start_date' => '2023-06-28',
                'end_date' => '2023-06-17',
                'customer_id' => 12,
                'customerName' => 'danish',
                'customerOrder' => 'Cat tiner',
                'description' => '4000 kilogram',
                'status' => 'active',
                'company_registration_number' => null,
                'order_photo' => null,
                'additional_info' => null,
            ],
            // Add other funding records here
        ]);
    }
}
