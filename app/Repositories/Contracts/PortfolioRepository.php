<?php

namespace App\Repositories\Contracts;

/**
 * Interface PortfolioRepository
 * @package App\Repositories\Contracts
 */
interface PortfolioRepository
{
    /**
     * @param array $columns
     * @return mixed
     */
    public function all($columns = array('*'));

    /**
     * @param array $columns
     * @return mixed
     */
    public function latest($columns = array('*'));

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
     * @param $portfolio
     * @return mixed
     */
    public function update($request, $portfolio);

    /**
     * @param $portfolio
     * @return mixed
     */
    public function delete($portfolio);
}
