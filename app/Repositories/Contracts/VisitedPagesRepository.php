<?php

namespace App\Repositories\Contracts;

/**
 * Interface VisitedPagesRepository
 * @package App\Repositories\Contracts
 */
interface VisitedPagesRepository
{
    /**
     * @param array $columns
     * @return mixed
     */
    public function all($columns = array('*'));

    /**
     * @param int $perPage
     * @param array $columns
     * @return mixed
     */
    public function paginate($perPage = 15, $columns = array('*'));

    /**
     * @param array $attributes
     * @return mixed
     */
    public function firstOrNew(array $attributes);

    /**
     * @param array $attributes
     * @param array $values
     * @return mixed
     */
    public function updateOrCreate(array $attributes, array $values = array());

    /**
     * @return int
     */
    public function incrementCount();

    /**
     * @param $range
     * @param array $columns
     * @return mixed
     */
    public function whereBetweenGroupByPage($range, $columns = ['*']);

    /**
     * @return mixed
     */
    public function getAllVisitedPagesGroupByPage();
}
