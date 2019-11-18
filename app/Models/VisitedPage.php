<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VisitedPage extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'visitor_id',
        'page',
        'additional_data',
        'count'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function visitors()
    {
        return $this->belongsToMany('App\Models\Visitor', 'visitors');
    }
}
