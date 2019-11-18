<?php

namespace App\Console\Commands;

use App\Models\Permission;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class AuthPermissionCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'auth:permission {name} {--R|remove}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create permissions';

    /**
     * Create a new command instance.
     *
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $permissions = $this->generatePermissions();

        // check if its remove
        if ($is_remove = $this->option('remove')) {
            // remove permission
            if (Permission::where('slug', 'LIKE', '%' . $this->getNameArgument())->delete()) {
                $this->warn('Permissions ' . implode(', ', $permissions) . ' deleted.');
            } else {
                $this->warn('No permissions for ' . $this->getNameArgument() . ' found!');
            }

        } else {
            // create permissions
            foreach ($permissions as $permission) {
                Permission::firstOrCreate(['slug' => $permission, 'name' => $this->getNamePermission($permission)]);
            }

            $this->info('Permissions ' . implode(', ', $permissions) . ' created.');
        }
    }

    /**
     * @param $permission
     * @return string
     */
    private function getNamePermission($permission)
    {
        return Str::title(Str::replaceFirst('_', ' ', $permission));
    }

    /**
     * @return array
     */
    private function generatePermissions()
    {
        $abilities = ['view', 'create', 'update', 'delete'];
        $name = $this->getNameArgument();

        return array_map(function ($val) use ($name) {
            return $val . '_' . $name;
        }, $abilities);
    }

    /**
     * @return string
     */
    private function getNameArgument()
    {
        return strtolower(Str::plural($this->argument('name')));
    }
}
