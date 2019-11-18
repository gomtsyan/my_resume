<?php

namespace App\Repositories\Contracts;

/**
 * Interface ArticlesRepository
 * @package App\Repositories\Contracts
 */
interface ArticlesRepository
{
    /**
     * @param array $columns
     * @return mixed
     */
    public function all($columns = array('*'));

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
     * @param $article
     * @return mixed
     */
    public function update($request, $article);

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id);

    /**
     * @param array $columns
     * @return mixed
     */
    public function getRecent($columns = array('*'));

    /**
     * @param $articleCategory
     * @param array $columns
     * @return mixed
     */
    public function get($articleCategory, $columns = array('*'));
}
