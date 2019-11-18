<?php

namespace App\Models;

use App\Traits\HasPermissions;
use App\Traits\RouteBinding;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    use HasPermissions;
    use RouteBinding;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'login'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @return string
     */
    public function getRoleNamesAttribute()
    {
        return $this->roles()->pluck('name');
    }

    /**
     * @return string
     */
    public function getRolesArrayAttribute()
    {
        return $this->roles()->pluck('role_id');
    }
}
