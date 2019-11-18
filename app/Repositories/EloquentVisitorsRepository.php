<?php

namespace App\Repositories;

use App\Models\Visitor;
use app\Repositories\Contracts\VisitorsRepository;
use Carbon\Carbon;

class EloquentVisitorsRepository extends EloquentBaseRepository implements VisitorsRepository
{
    /**
     * @var string
     */
    protected $dateKey = 'updated_at';

    /**
     * EloquentVisitorsRepository constructor.
     * @param Visitor $model
     */
    public function __construct(Visitor $model)
    {
        $this->model = $model;
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function save(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * @param $ip
     * @param $attributes
     * @return mixed
     */
    public function updateByIp($ip, $attributes)
    {
        return $this->model->whereIp($ip)->update($attributes);
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
            $instance->increment('visit_count');
        }

        $instance->fill($values)->save();

        return $instance;
    }

    /**
     * @param $range
     * @return mixed
     */
    public function whereBetweenGroupByDate($range)
    {
        return $this->groupByDate($this->between($range));
    }

    /**
     * @param $range
     * @param array $columns
     * @return mixed
     */
    public function whereBetween($range, $columns = ['*'])
    {
        return $this->between($range, $columns);
    }

    /**
     * @param $where
     * @return mixed
     */
    public function whereGroupByDate($where)
    {
        return $this->groupByDate($this->model->whereDate($this->dateKey, $where)->get());
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

    /**
     * @param $collection
     * @return mixed
     */
    protected function groupByDate($collection)
    {
        return $collection->groupBy(function ($item) {
            $dateKey = $this->dateKey;
            return Carbon::parse($item->$dateKey)->format('Y-m-d');
        });
    }
}
