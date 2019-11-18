<?php

namespace App\Repositories\Contracts;

/**
 * Interface EducationsRepository
 * @package App\Repositories\Contracts
 */
interface EducationsRepository
{
    /**
     * @param array $columns
     * @return mixed
     */
    public function all($columns = array('*'));

    /**
     * @param $request
     * @return mixed
     */
    public function create($request);

    /**
     * @param $request
     * @param $institution
     * @return mixed
     */
    public function update($request, $institution);

    /**
     * @param $institution
     * @return mixed
     */
    public function delete($institution);
}
