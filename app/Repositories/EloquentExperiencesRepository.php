<?php

namespace App\Repositories;

use App\Models\Experience;
use app\Repositories\Contracts\ExperiencesRepository;

class EloquentExperiencesRepository extends EloquentBaseRepository implements ExperiencesRepository
{
    /**
     * EloquentExperiencesRepository constructor.
     * @param Experience $model
     */
    public function __construct(Experience $model)
    {
        $this->model = $model;
    }

    /**
     * @param array $columns
     * @return mixed
     */
    public function all($columns = array('*'))
    {
        return $this->model->latest('start_date')->get($columns);
    }
}
