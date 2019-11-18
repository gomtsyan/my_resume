<?php

namespace App\Models;

use App\Traits\RouteBinding;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    use RouteBinding;

    /**
     * @var string
     */
    protected $table = 'educations';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'institution',
        'degree',
        'specialization',
        'description',
        'location',
        'start_date',
        'end_date'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date'
    ];

    /**
     * @return string
     */
    public function getDurationAttribute()
    {
        return $this->start . ' - ' . $this->end;
    }

    /**
     * @return string
     */
    public function getStartAttribute()
    {
        return $this->start_date->format('m/Y');
    }

    /**
     * @return string
     */
    public function getEndAttribute()
    {
        return is_null($this->end_date) ? 'Current' : $this->end_date->format('m/Y');
    }

    /**
     * @return string
     */
    public function getShowStartAttribute()
    {
        return $this->start_date->format('Y-m-d');
    }

    /**
     * @return string
     */
    public function getShowEndAttribute()
    {
        return is_null($this->end_date) ? null : $this->end_date->format('Y-m-d');
    }

}
