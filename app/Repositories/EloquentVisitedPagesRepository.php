<?php

namespace App\Repositories;

use App\Models\VisitedPage;
use app\Repositories\Contracts\VisitedPagesRepository;

class EloquentVisitedPagesRepository extends EloquentBaseRepository implements VisitedPagesRepository
{
    /**
     * @var string
     */
    protected $dateKey = 'updated_at';

    /**
     * EloquentVisitedPagesRepository constructor.
     * @param VisitedPage $model
     */
    public function __construct(VisitedPage $model)
    {
        $this->model = $model;
    }

    /**
     * @param array $attributes
     * @param array $values
     * @return mixed
     */
    public function updateOrCreate(array $attributes, array $values = array())
    {
        $instance = $this->model->firstOrNew($attributes);

        if ($instance->id) {
            $instance->touch();
            $instance->increment('count');
        }

        $instance->fill($values)->save();

        return $instance;
    }

    /**
     * @param array $attributes
     * @return mixed
     */
    public function firstOrNew(array $attributes)
    {
        return $this->model->firstOrNew($attributes);
    }

    /**
     * @return int
     */
    public function incrementCount()
    {
        return $this->model->increment('count');
    }

    /**
     * @param $range
     * @param array $columns
     * @return mixed
     */
    public function whereBetweenGroupByPage($range, $columns = ['*'])
    {
        return $this->groupByPage($this->between($range, $columns));
    }

    /**
     * @return mixed
     */
    public function getAllVisitedPagesGroupByPage()
    {
        return $this->groupByPage($this->getAllVisitedPagesTotalCounts());
    }

    /**
     * @return mixed
     */
    protected function getAllVisitedPagesTotalCounts()
    {
        return $this->model->get(['page', 'count']);
    }

    /**
     * @param $collection
     * @return mixed
     */
    protected function groupByPage($collection)
    {
        return $collection->groupBy(function ($item) {
            return $item->page;
        });
    }

    /**
     * @param $range
     * @param array $columns
     * @return mixed
     */
    protected function between($range, $columns = ['*'])
    {
        return $this->model->whereBetween($this->dateKey, $range)->get($columns);
    }
}
