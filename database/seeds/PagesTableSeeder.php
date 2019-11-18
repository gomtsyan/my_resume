<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class PagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(Schema::hasTable('pages')) {
            DB::table('pages')->insert($this->getInsertData());
        }
    }

    /**
     * @return array
     */
    protected function getInsertData()
    {
        return [
            [
                'name' => 'index',
                'title' => 'Index Page',
                'path' => '/',
                'img' => '{"medium":"D1yqiNSY_medium.png","small":"RHVaQS6J_small.png"}'
            ],
            [
                'name' => 'profile',
                'title' => 'Profile',
                'path' => 'profile',
                'img' => '{"medium":"NeFIAGCs_medium.png","small":"PJezfO91_small.png"}'
            ],
            [
                'name' => 'resume',
                'title' => 'Resume',
                'path' => 'resume',
                'img' => '{"medium":"dA8w8ZFl_medium.png","small":"PZc8qLMD_small.png"}'
            ],
            [
                'name' => 'portfolio',
                'title' => 'Portfolio',
                'path' => 'portfolio',
                'img' => '{"medium":"GEO2iGYM_medium.png","small":"87B2UlYA_small.png"}'
            ],
            [
                'name' => 'contact',
                'title' => 'Contact',
                'path' => 'contacts',
                'img' => '{"medium":"umJAWhWj_medium.png","small":"reXgbhJL_small.png"}'
            ],
            [
                'name' => 'article',
                'title' => 'Blog',
                'path' => 'articles',
                'img' => '{"medium":"Kmu6ZA5E_medium.png","small":"7xmXWaTi_small.png"}'
            ]
        ];
    }
}
