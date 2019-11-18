<?php

namespace App\Repositories\Contracts;

/**
 * Interface RolesRepository
 * @package App\Repositories\Contracts
 */
interface RolesRepository
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
     * @param $role
     * @return mixed
     */
    public function update($request, $role);

    /**
     * @param $role
     * @return mixed
     */
    public function delete($role);

    /**
     * @param $request
     * @return array
     */
    public function changePermissions($request);
}
