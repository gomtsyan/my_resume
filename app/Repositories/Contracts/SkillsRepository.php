<?php

namespace App\Repositories\Contracts;

/**
 * Interface SkillsRepository
 * @package App\Repositories\Contracts
 */
interface SkillsRepository
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
     * @param $category
     * @return mixed
     */
    public function update($request, $category);

    /**
     * @param $category
     * @return mixed
     */
    public function delete($category);
}
