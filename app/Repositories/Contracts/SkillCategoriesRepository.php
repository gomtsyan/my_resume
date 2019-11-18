<?php

namespace App\Repositories\Contracts;

/**
 * Interface SkillCategoriesRepository
 * @package App\Repositories\Contracts
 */
interface SkillCategoriesRepository
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
     * @param $skill
     * @return mixed
     */
    public function update($request, $skill);

    /**
     * @param $skill
     * @return mixed
     */
    public function delete($skill);
}
