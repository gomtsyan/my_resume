<?php

namespace App\Repositories\Contracts;

/**
 * Interface ContactMeRepository
 * @package App\Repositories\Contracts
 */
interface ContactMeRepository
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
    public function create(array $data);

    /**
     * @param $id
     * @return mixed
     */
    public function updateMessageAsViewed($id);

    /**
     * @param $message
     * @return mixed
     */
    public function delete($message);

    /**
     * @param $take
     * @param array $columns
     * @return mixed
     */
    public function take($take, $columns = array('*'));

    /**
     * @param $attribute
     * @param $value
     * @return mixed
     */
    public function getCountBy($attribute, $value);

    /**
     * @param $value
     * @return mixed
     */
    public function search($value);
}
