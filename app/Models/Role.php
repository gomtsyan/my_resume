<?php

namespace App\Models;

use App\Traits\RouteBinding;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use RouteBinding;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'slug'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function permissions()
    {
        return $this->belongsToMany('App\Models\Permission', 'permission_role');
    }

    /**
     * @param $permissionData
     * @param bool $require
     * @return bool
     */
    public function hasPermissions($permissionData, $require = false)
    {
        if (is_array($permissionData)) {
            foreach ($permissionData as $permission) {
                $permission = $this->hasPermissions($permission);

                if ($permission && !$require) {
                    return true;
                } elseif (!$permission && $require) {
                    return false;
                }
            }

            return $require;

        } else {
            $rolePermissions = $this->permissions()->get();
            foreach ($rolePermissions as $rolePermission) {
                if ($rolePermission->name == $permissionData) {
                    return true;
                }
            }
        }
    }

    /**
     * @param $inputPermissions
     * @return bool
     */
    public function savePermissions($inputPermissions)
    {
        if (!empty($inputPermissions)) {
            $this->permissions()->sync($inputPermissions);
        } else {
            $this->permissions()->detach();
        }

        return true;
    }
}
