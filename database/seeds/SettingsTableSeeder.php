<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(Schema::hasTable('settings')) {
            DB::table('settings')->insert($this->getInsertData());
        }
    }

    /**
     * @return array
     */
    protected function getInsertData()
    {
        return [
            [
                'name' => 'Theme Color',
                'key' => 'theme_color',
                'value' => 'blue',
                'type' => 'select2',
            ],
            [
                'name' => 'Articles Count',
                'key' => 'articles_count',
                'value' => '3',
                'type' => 'select2',
            ],
            [
                'name' => 'Recent Posts',
                'key' => 'recent_posts',
                'value' => '2',
                'type' => 'select2',
            ]
        ];
    }
}
