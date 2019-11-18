<?php

namespace App\Repositories\Contracts;

/**
 * Interface UsersRepository
 * @package App\Repositories\Contracts
 */
interface UsersRepository
{
    /**
     * @param int $perPage
     * @param array $columns
     * @return mixed
     */
    public function paginate($perPage = 15, $columns = array('*'));

    /**
     * @param $request
     * @return mixed
     */
    public function create($request);

    /**
     * @param $request
     * @param $user
     * @return mixed
     */
    public function update($request, $user);

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id);
}
