<?php

namespace App\Repositories;

use App\Models\Setting;
use app\Repositories\Contracts\SettingsRepository;

class EloquentSettingsRepository extends EloquentBaseRepository implements SettingsRepository
{
    /**
     * EloquentSettingsRepository constructor.
     * @param Setting $model
     */
    public function __construct(Setting $model)
    {
        $this->model = $model;
    }

    /**
     *
     * @return mixed
     */
    public function pluck()
    {
        return $this->model->pluck('value', 'key');
    }
}
