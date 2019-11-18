<?php

namespace App\Models;

use App\Traits\RouteBinding;
use Illuminate\Database\Eloquent\Model;

class SkillCategory extends Model
{
    use RouteBinding;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function skills() {
        return $this->hasMany('App\Models\Skill');
    }
}
