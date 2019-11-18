<?php

namespace App\Models;

use App\Traits\RouteBinding;
use Illuminate\Database\Eloquent\Model;

class LanguageSkill extends Model
{
    use RouteBinding;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'rating',
        'max_rating',
        'order'
    ];
}
