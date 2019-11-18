<?php

namespace App\Models;

use App\Traits\RouteBinding;
use Illuminate\Database\Eloquent\Model;

class PersonalInfo extends Model
{
    use RouteBinding;

    /**
     * @var string
     */
    protected $table = 'personal_info';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'position',
        'img'
    ];

    /**
     * @return string
     */
    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }
}
