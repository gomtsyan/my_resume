<?php

namespace App\Models;

use App\Traits\RouteBinding;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use RouteBinding;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'value',
        'icon',
        'is_social'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'is_social' => 'boolean'
    ];

    /**
     * Scope a query to only include social contacts.
     *
     * @param $query
     * @return mixed
     */
    public function scopeSocial($query)
    {
        return $query->where('is_social', '1');
    }
}
