<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(Schema::hasTable('permissions')) {
            DB::table('permissions')->insert($this->getInsertData());
        }
    }

    /**
     * @return array
     */
    protected function getInsertData()
    {
        return [
            ['slug' => 'view_permissions', 'name' => 'View Permissions'],
            ['slug' => 'create_permissions', 'name' => 'Create Permissions'],
            ['slug' => 'update_permissions', 'name' => 'Update Permissions'],
            ['slug' => 'delete_permissions', 'name' => 'Delete Permissions'],
            ['slug' => 'view_settings', 'name' => 'View Settings'],
            ['slug' => 'create_settings', 'name' => 'Create Settings'],
            ['slug' => 'update_settings', 'name' => 'Update Settings'],
            ['slug' => 'delete_settings', 'name' => 'Delete Settings'],
            ['slug' => 'view_profiles', 'name' => 'View Profile'],
            ['slug' => 'create_profiles', 'name' => 'Create Profile'],
            ['slug' => 'update_profiles', 'name' => 'Update Profile'],
            ['slug' => 'delete_profiles', 'name' => 'Delete Profile'],
            ['slug' => 'view_users', 'name' => 'View Users'],
            ['slug' => 'create_users', 'name' => 'Create Users'],
            ['slug' => 'update_users', 'name' => 'Update Users'],
            ['slug' => 'delete_users', 'name' => 'Delete Users'],
            ['slug' => 'view_messages', 'name' => 'View Messages'],
            ['slug' => 'delete_messages', 'name' => 'Delete Messages'],
            ['slug' => 'view_pages', 'name' => 'View Pages'],
            ['slug' => 'create_pages', 'name' => 'Create Pages'],
            ['slug' => 'update_pages', 'name' => 'Update Pages'],
            ['slug' => 'delete_pages', 'name' => 'Delete Pages'],
            ['slug' => 'view_personal_infos', 'name' => 'View Personal_Info'],
            ['slug' => 'create_personal_infos', 'name' => 'Create Personal_Info'],
            ['slug' => 'update_personal_infos', 'name' => 'Update Personal_Info'],
            ['slug' => 'delete_personal_infos', 'name' => 'Delete Personal_Info'],
            ['slug' => 'view_language_skills', 'name' => 'View Language_Skills'],
            ['slug' => 'create_language_skills', 'name' => 'Create Language_Skills'],
            ['slug' => 'update_language_skills', 'name' => 'Update Language_Skills'],
            ['slug' => 'delete_language_skills', 'name' => 'Delete Language_Skills'],
            ['slug' => 'view_skill_categories', 'name' => 'View Skill_Categories'],
            ['slug' => 'create_skill_categories', 'name' => 'Create Skill_Categories'],
            ['slug' => 'update_skill_categories', 'name' => 'Update Skill_Categories'],
            ['slug' => 'delete_skill_categories', 'name' => 'Delete Skill_Categories'],
            ['slug' => 'view_skills', 'name' => 'View Skills'],
            ['slug' => 'create_skills', 'name' => 'Create Skills'],
            ['slug' => 'update_skills', 'name' => 'Update Skills'],
            ['slug' => 'delete_skills', 'name' => 'Delete Skills'],
            ['slug' => 'view_experiences', 'name' => 'View Experiences'],
            ['slug' => 'create_experiences', 'name' => 'Create Experiences'],
            ['slug' => 'update_experiences', 'name' => 'Update Experiences'],
            ['slug' => 'delete_experiences', 'name' => 'Delete Experiences'],
            ['slug' => 'view_education', 'name' => 'View Education'],
            ['slug' => 'create_education', 'name' => 'Create Education'],
            ['slug' => 'update_education', 'name' => 'Update Education'],
            ['slug' => 'delete_education', 'name' => 'Delete Education'],
            ['slug' => 'view_portfolios', 'name' => 'View Portfolios'],
            ['slug' => 'create_portfolios', 'name' => 'Create Portfolios'],
            ['slug' => 'update_portfolios', 'name' => 'Update Portfolios'],
            ['slug' => 'delete_portfolios', 'name' => 'Delete Portfolios'],
            ['slug' => 'view_contacts', 'name' => 'View Contacts'],
            ['slug' => 'create_contacts', 'name' => 'Create Contacts'],
            ['slug' => 'update_contacts', 'name' => 'Update Contacts'],
            ['slug' => 'delete_contacts', 'name' => 'Delete Contacts'],
            ['slug' => 'view_articles', 'name' => 'View Articles'],
            ['slug' => 'create_articles', 'name' => 'Create Articles'],
            ['slug' => 'update_articles', 'name' => 'Update Articles'],
            ['slug' => 'delete_articles', 'name' => 'Delete Articles'],
            ['slug' => 'view_article_categories', 'name' => 'View Article_Categories'],
            ['slug' => 'create_article_categories', 'name' => 'Create Article_Categories'],
            ['slug' => 'update_article_categories', 'name' => 'Update Article_Categories'],
            ['slug' => 'delete_article_categories', 'name' => 'Delete Article_Categories'],
            ['slug' => 'view_comments', 'name' => 'View Comments'],
            ['slug' => 'create_comments', 'name' => 'Create Comments'],
            ['slug' => 'update_comments', 'name' => 'Update Comments'],
            ['slug' => 'delete_comments', 'name' => 'Delete Comments'],
            ['slug' => 'view_roles', 'name' => 'View Roles'],
            ['slug' => 'create_roles', 'name' => 'Create Roles'],
            ['slug' => 'update_roles', 'name' => 'Update Roles'],
            ['slug' => 'delete_roles', 'name' => 'Delete Roles'],
            ['slug' => 'view_visitors', 'name' => 'View Visitors'],
            ['slug' => 'create_visitors', 'name' => 'Create Visitors'],
            ['slug' => 'update_visitors', 'name' => 'Update Visitors'],
            ['slug' => 'delete_visitors', 'name' => 'Delete Visitors']
        ];
    }
}
