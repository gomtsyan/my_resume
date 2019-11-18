<?php

namespace App\Models;

use App\Traits\Searchable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ContactMe extends Model
{
    use Searchable;

    /**
     * Search fields
     * @var array
     */
    protected $search = ['name', 'email', 'message'];

    /**
     * @var string
     */
    protected $table = 'contact_me';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'message',
        'is_viewed'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'is_viewed' => 'boolean',
        'created_at' => 'dateTime'
    ];

    /**
     * @return string
     */
    public function getDateRangeAttribute()
    {
        $now = Carbon::now();
        $diffInHours = $now->diffInHours($this->created_at);

        return $now->subHours($diffInHours)->diffForHumans(
            [
                'options' => Carbon::JUST_NOW | Carbon::ONE_DAY_WORDS | Carbon::TWO_DAY_WORDS
            ]
        );
    }

    /**
     * @return string
     */
    public function getShortDescriptionAttribute()
    {
        return Str::limit($this->message, 70, '...');
    }

    /**
     * @return string
     */
    public function getCreatedDateTimeAttribute()
    {
        return $this->created_at->format('m/Y');
    }
}
