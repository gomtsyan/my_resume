<?php

namespace App\Repositories;

use App\Models\ContactMe;
use app\Repositories\Contracts\ContactMeRepository;

class EloquentContactMeRepository extends EloquentBaseRepository implements ContactMeRepository
{
    /**
     * EloquentContactMeRepository constructor.
     * @param ContactMe $model
     */
    public function __construct(ContactMe $model)
    {
        $this->model = $model;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function updateMessageAsViewed($id)
    {
        return $this->model->whereId($id)->update(['is_viewed' => '1']);
    }

    /**
     * @param $take
     * @param array $columns
     * @return mixed
     */
    public function take($take, $columns = array('*'))
    {
        return $this->model->take($take)->latest()->get($columns);
    }

    /**
     * @param $attribute
     * @param $value
     * @return mixed
     */
    public function getCountBy($attribute, $value)
    {
        return $this->model->where($attribute, $value)->count();
    }

    /**
     * @param $value
     * @return mixed
     */
    public function search($value)
    {
        return $this->model::search($value)->latest()->get();
    }
}
