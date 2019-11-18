<?php

namespace App\Repositories\Contracts;

/**
 * Interface SettingsRepository
 * @package App\Repositories\Contracts
 */
interface SettingsRepository
{
    /**
     *
     * @param array $columns
     * @return mixed
     */
    public function all($columns = array('*'));

    /**
     *
     * @return mixed
     */
    public function pluck();

    /**
     * @param $request
     * @return mixed
     */
    public function create($request);

    /**
     * @param $request
     * @param $setting
     * @return mixed
     */
    public function update($request, $setting);

    /**
     * @param $setting
     * @return mixed
     */
    public function delete($setting);
}
