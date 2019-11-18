<?php

namespace App\Repositories\Contracts;

/**
 * Interface VisitorsRepository
 * @package App\Repositories\Contracts
 */
interface VisitorsRepository
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
     * @param array $data
     * @return mixed
     */
    public function save(array $data);

    /**
     * @param $ip
     * @param $attributes
     * @return mixed
     */
    public function updateByIp($ip, $attributes);

    /**
     * @param array $attributes
     * @param array $values
     * @return mixed
     */
    public function updateOrCreate(array $attributes, array $values = array());

    /**
     * @param $range
     * @return mixed
     */
    public function whereBetweenGroupByDate($range);

    /**
     * @param $range
     * * @param array $columns
     * @return mixed
     */
    public function whereBetween($range, $columns);

    /**
     * @param $where
     * @return mixed
     */
    public function whereGroupByDate($where);
}
