<?php

namespace App\Repositories\Contracts;

/**
 * Interface PersonalInfoRepository
 * @package App\Repositories\Contracts
 */
interface PersonalInfoRepository
{
    /**
     * @param $request
     * @return mixed
     */
    public function create($request);

    /**
     * @param $request
     * @param $personalInfo
     * @return mixed
     */
    public function update($request, $personalInfo);

    /**
     * @param $personalInfo
     * @return mixed
     */
    public function delete($personalInfo);

    /**
     * @param array $columns
     * @return mixed
     */
    public function first($columns = array('*'));
}
