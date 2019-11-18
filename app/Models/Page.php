<?php

namespace App\Models;

use App\Traits\RouteBinding;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use RouteBinding;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'title',
        'path',
        'img',
        'sub_title',
        'keywords',
        'meta_desc',
        'is_active',
        'order'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'is_active' => 'boolean',
        'order' => 'integer',
        'img' => 'object'
    ];

    /**
     * Scope a query to only include active pages.
     *
     * @param $query
     * @return mixed
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', '1');
    }
}
