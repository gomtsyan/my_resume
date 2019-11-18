<?php

namespace App\Repositories\Contracts;

/**
 * Interface PermissionsRepository
 * @package App\Repositories\Contracts
 */
interface PermissionsRepository
{
    /**
     * @param array $columns
     * @return mixed
     */
    public function all($columns = array('*'));

    /**
     * @param $privilege
     * @return mixed
     */
    public function delete($privilege);
}
