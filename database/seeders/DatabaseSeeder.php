<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(InvestorsTableSeeder::class);
        $this->call(CompaniesTableSeeder::class);
        // $this->call(FundingsTableSeeder::class);
        // $this->call(ProjectsTableSeeder::class);
        // $this->call(InvestmentsTableSeeder::class);
    }
}

class UsersTableSeeder extends Seeder
{
    /**
     * Seed the users table.
     */
    public function run()
    {
        if ($this->hasAlreadyRun('users')) {
            $this->command->info('Skipping UsersTableSeeder as it has already run.');
            return;
        }

        // Your seeding logic for the users table here
        $users = [
            // User records to be inserted
        ];

        DB::table('users')->insert($users);
    }

    /**
     * Check if the seeder has already been run.
     *
     * @param  string  $table
     * @return bool
     */
    protected function hasAlreadyRun($table)
    {
        $count = DB::table($table)->count();
        return $count > 0;
    }
}

class InvestorsTableSeeder extends Seeder
{
    /**
     * Seed the investors table.
     */
    public function run()
    {
        if ($this->hasAlreadyRun('investors')) {
            $this->command->info('Skipping InvestorsTableSeeder as it has already run.');
            return;
        }

        // Your seeding logic for the investors table here
        $investors = [
            // Investor records to be inserted
        ];

        DB::table('investors')->insert($investors);
    }

    /**
     * Check if the seeder has already been run.
     *
     * @param  string  $table
     * @return bool
     */
    protected function hasAlreadyRun($table)
    {
        $count = DB::table($table)->count();
        return $count > 0;
    }
}

class CompaniesTableSeeder extends Seeder
{
    /**
     * Seed the companies table.
     */
    public function run()
    {
        if ($this->hasAlreadyRun('companies')) {
            $this->command->info('Skipping CompaniesTableSeeder as it has already run.');
            return;
        }

        // Your seeding logic for the companies table here
        $companies = [
            // Company records to be inserted
        ];

        DB::table('companies')->insert($companies);
    }

    /**
     * Check if the seeder has already been run.
     *
     * @param  string  $table
     * @return bool
     */
    protected function hasAlreadyRun($table)
    {
        $count = DB::table($table)->count();
        return $count > 0;
    }
}

class FundingsTableSeeder extends Seeder
{
    /**
     * Seed the fundings table.
     */
    public function run()
    {
        if ($this->hasAlreadyRun('fundings')) {
            $this->command->info('Skipping FundingsTableSeeder as it has already run.');
            return;
        }

        // Your seeding logic for the fundings table here
        $fundings = [
            // Funding records to be inserted
        ];

        DB::table('fundings')->insert($fundings);
    }

    /**
     * Check if the seeder has already been run.
     *
     * @param  string  $table
     * @return bool
     */
    protected function hasAlreadyRun($table)
    {
        $count = DB::table($table)->count();
        return $count > 0;
    }
}

class ProjectsTableSeeder extends Seeder
{
    /**
     * Seed the projects table.
     */
    public function run()
    {
        if ($this->hasAlreadyRun('projects')) {
            $this->command->info('Skipping ProjectsTableSeeder as it has already run.');
            return;
        }

        // Your seeding logic for the projects table here
        $projects = [
            // Project records to be inserted
        ];

        DB::table('projects')->insert($projects);
    }

    /**
     * Check if the seeder has already been run.
     *
     * @param  string  $table
     * @return bool
     */
    protected function hasAlreadyRun($table)
    {
        $count = DB::table($table)->count();
        return $count > 0;
    }
}

class InvestmentsTableSeeder extends Seeder
{
    /**
     * Seed the investments table.
     */
    public function run()
    {
        if ($this->hasAlreadyRun('investments')) {
            $this->command->info('Skipping InvestmentsTableSeeder as it has already run.');
            return;
        }

        // Your seeding logic for the investments table here
        $investments = [
            // Investment records to be inserted
        ];

        DB::table('investments')->insert($investments);
    }

    /**
     * Check if the seeder has already been run.
     *
     * @param  string  $table
     * @return bool
     */
    protected function hasAlreadyRun($table)
    {
        $count = DB::table($table)->count();
        return $count > 0;
    }
}
