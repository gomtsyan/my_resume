<?php

namespace App\Models;

use App\Traits\RouteBinding;
use Illuminate\Database\Eloquent\Model;

class AboutMe extends Model
{
    use RouteBinding;

    /**
     * @var string
     */
    protected $table = 'about_me';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'text', 'cv', 'img'
    ];
}
