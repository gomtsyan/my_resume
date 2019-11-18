<?php

namespace App\Repositories\Contracts;

/**
 * Interface AboutMeRepository
 * @package App\Repositories\Contracts
 */
interface AboutMeRepository
{
    /**
     * @param $request
     * @return mixed
     */
    public function create($request);

    /**
     * @param $request
     * @param $profile
     * @return mixed
     */
    public function update($request, $profile);

    /**
     * @param $profile
     * @return mixed
     */
    public function delete($profile);

    /**
     * @param array $columns
     * @return mixed
     */
    public function first($columns = array('*'));
}
