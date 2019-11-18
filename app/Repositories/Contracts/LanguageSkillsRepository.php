<?php

namespace App\Repositories\Contracts;

/**
 * Interface LanguageSkillsRepository
 * @package App\Repositories\Contracts
 */
interface LanguageSkillsRepository
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
