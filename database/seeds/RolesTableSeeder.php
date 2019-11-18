<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(Schema::hasTable('roles')) {
            DB::table('roles')->insert([
                'slug' => 'admin',
                'name' => 'Admin'
            ]);
        }
    }
}
