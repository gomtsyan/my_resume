<?php

namespace App\Repositories;

use App\Models\Education;
use app\Repositories\Contracts\EducationsRepository;

class EloquentEducationsRepository extends EloquentBaseRepository implements EducationsRepository
{
    /**
     * EloquentEducationsRepository constructor.
     * @param Education $model
     */
    public function __construct(Education $model)
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
