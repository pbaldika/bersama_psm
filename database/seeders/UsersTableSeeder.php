<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'id' => 1,
                'name' => 'old company',
                'email' => 'aldikaanantabagus@gmail.com',
                'telephone' => '+696969',
                'gender' => 'Female',
                'address' => 'new address 123',
                'email_verified_at' => '2023-04-11 23:58:29',
                'dob' => '2023-05-14 00:00:00',
                'password' => '$2y$10$B402bDlpb0hrlJ5eS3QY.umIuCCIew86vsY4ZAE6wfwALM6G/AKIK',
                'two_factor_secret' => null,
                'two_factor_recovery_codes' => null,
                'two_factor_confirmed_at' => null,
                'role' => 'company',
                'remember_token' => null,
                'created_at' => '2023-04-09 05:11:51',
                'updated_at' => '2023-06-20 20:36:15',
                'verified' => 'tolak',
            ],
            [
                'id' => 2,
                'name' => 'adminnow',
                'email' => 'test@gmail.com',
                'telephone' => '+62333333',
                'gender' => 'Male',
                'address' => 'Vila Nusa Indah 2 Blok S6 No. 10, Bojong Kulur, Gunung Putri',
                'email_verified_at' => '2023-04-11 06:47:21',
                'dob' => '2023-05-25 00:00:00',
                'password' => '$2y$10$7vAOP5Kh3XDJss304.KTJOFxSaKQT2etuHbJAWGTBWzaSknQNOh.K',
                'two_factor_secret' => null,
                'two_factor_recovery_codes' => null,
                'two_factor_confirmed_at' => null,
                'role' => 'admin',
                'remember_token' => null,
                'created_at' => '2023-04-09 05:14:10',
                'updated_at' => '2023-06-12 20:07:17',
                'verified' => null,
            ],
            [
                'id' => 3,
                'name' => 'verify',
                'email' => 'verify@gmail.com',
                'telephone' => '+sdds',
                'gender' => 'Male',
                'address' => 'Vila Nusa Indah 2 Blok S6 No. 10, Bojong Kulur, Gunung Putri',
                'email_verified_at' => '2023-06-20 17:37:02',
                'dob' => '2023-04-02 00:00:00',
                'password' => '$2y$10$1qaaf.78ZJS3GoPnZfQJJuufX2y.sUIOjeH5A3R5vieyZhOgKUr3y',
                'two_factor_secret' => null,
                'two_factor_recovery_codes' => null,
                'two_factor_confirmed_at' => null,
                'role' => 'user',
                'remember_token' => 'jSJl830G35OaCvYY6rEet0nbHT8m3EwDKYnZFhHf4mvOtSw95EMDiqCqb0rd',
                'created_at' => '2023-04-11 04:43:34',
                'updated_at' => '2023-06-20 21:53:38',
                'verified' => 'verified',
            ],
        ]);
    }
}