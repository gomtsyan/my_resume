<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(Schema::hasTable('users')) {
            DB::table('users')->insert([
                'name' => 'Admin',
                'login' => 'admin',
                'email' => 'admin@admin.com',
                'password' => bcrypt('01234567'),
            ]);
        }
    }
}
