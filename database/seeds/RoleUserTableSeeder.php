<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class RoleUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(Schema::hasTable('role_user')) {
            DB::table('role_user')->insert([
                'role_id' => 1,
                'user_id' => 1
            ]);
        }
    }
}
