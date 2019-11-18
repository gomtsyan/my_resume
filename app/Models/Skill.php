<?php

namespace App\Models;

use App\Traits\RouteBinding;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    use RouteBinding;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'category_id'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category() {
        return $this->belongsTo('App\Models\SkillCategory')->withDefault([
            'title' => 'Other'
        ]);
    }
}
