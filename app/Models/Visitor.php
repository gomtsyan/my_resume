<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ip',
        'browser',
        'os',
        'continent_name',
        'country_code',
        'country_name',
        'country_flag',
        'region_name',
        'city',
        'count',
        'is_download_file',
        'latitude',
        'longitude'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'is_download_file' => 'boolean',
        'updated_at' => 'date'
    ];

    /**
     * Mutator that appends in query result sets as though it is part of db table
     *
     * @var array
     */
    protected $appends = ['last_visit'];

    /**
     * Last Visit Accessor.
     *
     * @return string
     */
    function getLastVisitAttribute()
    {
        return $this->updated_at->diffForHumans();
    }

    # global scope that will be applied to all queries
    public function newQuery()
    {
        return parent::newQuery()->orderBy('updated_at', 'DESC');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function visitedPages()
    {
        return $this->hasMany('App\Models\VisitedPage');
    }
}
