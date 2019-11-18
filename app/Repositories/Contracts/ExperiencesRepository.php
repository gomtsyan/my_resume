<?php

namespace App\Repositories\Contracts;

/**
 * Interface ExperiencesRepository
 * @package App\Repositories\Contracts
 */
interface ExperiencesRepository
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
     * @param $experience
     * @return mixed
     */
    public function update($request, $experience);

    /**
     * @param $experience
     * @return mixed
     */
    public function delete($experience);
}
