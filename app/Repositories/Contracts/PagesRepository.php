<?php

namespace App\Repositories\Contracts;

/**
 * Interface PagesRepository
 * @package App\Repositories\Contracts
 */
interface PagesRepository
{
    /**
     * @param $request
     * @return mixed
     */
    public function create($request);

    /**
     * @param $request
     * @param $pageData
     * @return mixed
     */
    public function update($request, $pageData);

    /**
     * @param $page
     * @return mixed
     */
    public function delete($page);

    /**
     * @param array $columns
     * @return mixed
     */
    public function getActivePages($columns = array('*'));

    /**
     * @param $field
     * @param $value
     * @param array $columns
     * @return mixed
     */
    public function getPageBy($field, $value, $columns = array('*'));
}
