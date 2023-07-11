<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InvestmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('investments')->insert([
            [
                'id' => 1,
                'created_at' => '2023-05-24 00:22:59',
                'updated_at' => '2023-06-12 20:12:05',
                'total' => 200000,
                'profit' => null,
                'status' => 'active',
                'payment_proof' => null,
                'user_id' => 5,
                'project_id' => 1,
                'payment_deadline' => null,
            ],
            [
                'id' => 2,
                'created_at' => '2023-05-24 00:50:43',
                'updated_at' => '2023-06-03 23:57:34',
                'total' => 200000,
                'profit' => null,
                'status' => 'request',
                'payment_proof' => null,
                'user_id' => 5,
                'project_id' => 1,
                'payment_deadline' => null,
            ],
            [
                'id' => 3,
                'created_at' => '2023-05-24 23:17:44',
                'updated_at' => '2023-05-24 23:49:15',
                'total' => 300,
                'profit' => null,
                'status' => 'request',
                'payment_proof' => null,
                'user_id' => 5,
                'project_id' => 3,
                'payment_deadline' => null,
            ],
            [
                'id' => 4,
                'created_at' => '2023-06-03 23:56:51',
                'updated_at' => '2023-06-03 23:56:51',
                'total' => 21323,
                'profit' => null,
                'status' => 'request',
                'payment_proof' => null,
                'user_id' => 5,
                'project_id' => 1,
                'payment_deadline' => null,
            ],
            [
                'id' => 5,
                'created_at' => '2023-06-03 23:56:55',
                'updated_at' => '2023-06-03 23:56:55',
                'total' => 123123,
                'profit' => null,
                'status' => 'request',
                'payment_proof' => null,
                'user_id' => 5,
                'project_id' => 1,
                'payment_deadline' => null,
            ],
            [
                'id' => 6,
                'created_at' => '2023-06-03 23:57:09',
                'updated_at' => '2023-06-03 23:58:22',
                'total' => 213123,
                'profit' => null,
                'status' => 'request',
                'payment_proof' => null,
                'user_id' => 5,
                'project_id' => 2,
                'payment_deadline' => null,
            ],
            [
                'id' => 7,
                'created_at' => '2023-06-22 03:52:16',
                'updated_at' => '2023-06-27 05:54:17',
                'total' => 10000,
                'profit' => null,
                'status' => 'active',
                'payment_proof' => '202306271202_contoh ktp.png',
                'user_id' => 7,
                'project_id' => 1,
                'payment_deadline' => null,
            ],
            [
                'id' => 8,
                'created_at' => '2023-06-22 03:52:34',
                'updated_at' => '2023-06-22 03:52:34',
                'total' => 2000,
                'profit' => null,
                'status' => 'request',
                'payment_proof' => null,
                'user_id' => 7,
                'project_id' => 1,
                'payment_deadline' => null,
            ],
            [
                'id' => 9,
                'created_at' => '2023-06-22 03:55:25',
                'updated_at' => '2023-06-25 20:14:13',
                'total' => 200000,
                'profit' => null,
                'status' => 'request',
                'payment_proof' => null,
                'user_id' => 7,
                'project_id' => 1,
                'payment_deadline' => null,
            ],
            [
                'id' => 10,
                'created_at' => '2023-06-22 03:55:57',
                'updated_at' => '2023-06-22 03:55:57',
                'total' => 10000,
                'profit' => null,
                'status' => 'request',
                'payment_proof' => null,
                'user_id' => 7,
                'project_id' => 1,
                'payment_deadline' => null,
            ],
            [
                'id' => 11,
                'created_at' => '2023-06-24 23:43:58',
                'updated_at' => '2023-06-24 23:43:58',
                'total' => 10000,
                'profit' => null,
                'status' => 'request',
                'payment_proof' => null,
                'user_id' => 7,
                'project_id' => 1,
                'payment_deadline' => null,
            ],
            [
                'id' => 12,
                'created_at' => '2023-06-24 23:44:27',
                'updated_at' => '2023-06-24 23:44:27',
                'total' => 10000,
                'profit' => null,
                'status' => 'request',
                'payment_proof' => null,
                'user_id' => 7,
                'project_id' => 1,
                'payment_deadline' => null,
            ],
            [
                'id' => 13,
                'created_at' => '2023-06-24 23:44:40',
                'updated_at' => '2023-06-24 23:44:40',
                'total' => 2000000,
                'profit' => null,
                'status' => 'request',
                'payment_proof' => null,
                'user_id' => 7,
                'project_id' => 1,
                'payment_deadline' => null,
            ],
            [
                'id' => 14,
                'created_at' => '2023-06-24 23:46:03',
                'updated_at' => '2023-06-24 23:46:03',
                'total' => 1000000,
                'profit' => null,
                'status' => 'request',
                'payment_proof' => null,
                'user_id' => 7,
                'project_id' => 1,
                'payment_deadline' => null,
            ],
            [
                'id' => 15,
                'created_at' => '2023-06-24 23:46:58',
                'updated_at' => '2023-06-24 23:46:58',
                'total' => 10000,
                'profit' => null,
                'status' => 'request',
                'payment_proof' => null,
                'user_id' => 7,
                'project_id' => 1,
                'payment_deadline' => null,
            ],
            [
                'id' => 16,
                'created_at' => '2023-06-24 23:47:39',
                'updated_at' => '2023-06-24 23:47:39',
                'total' => 1000,
                'profit' => null,
                'status' => 'request',
                'payment_proof' => null,
                'user_id' => 7,
                'project_id' => 1,
                'payment_deadline' => null,
            ],
            [
                'id' => 17,
                'created_at' => '2023-06-24 23:47:44',
                'updated_at' => '2023-06-24 23:47:44',
                'total' => 1000,
                'profit' => null,
                'status' => 'request',
                'payment_proof' => null,
                'user_id' => 7,
                'project_id' => 1,
                'payment_deadline' => null,
            ],
            [
                'id' => 18,
                'created_at' => '2023-06-25 19:29:12',
                'updated_at' => '2023-06-25 19:29:12',
                'total' => 4000000,
                'profit' => null,
                'status' => 'request',
                'payment_proof' => null,
                'user_id' => 7,
                'project_id' => 5,
                'payment_deadline' => null,
            ],
            [
                'id' => 19,
                'created_at' => '2023-07-01 07:47:06',
                'updated_at' => '2023-07-01 07:48:29',
                'total' => 20000000,
                'profit' => null,
                'status' => 'request',
                'payment_proof' => '202307011548_Aldika\'s Signature.png',
                'user_id' => 7,
                'project_id' => 1,
                'payment_deadline' => null,
            ],
            [
                'id' => 20,
                'created_at' => '2023-07-01 07:54:29',
                'updated_at' => '2023-07-01 08:05:15',
                'total' => 1000000,
                'profit' => null,
                'status' => 'active',
                'payment_proof' => '202307011555_1652511545.jpg',
                'user_id' => 7,
                'project_id' => 6,
                'payment_deadline' => null,
            ],
        ]);
    }
}