<?php

namespace App\Contracts;

/**
 * Interface VisitLogger
 * @package App\Contracts
 */
interface VisitLogger
{
    /**
     * Saves visitor info into db.
     *
     * @return mixed
     */
    public function save();

    /**
     * Saves visited page info into db.
     *
     * @param $instance
     * @param $visitPageData
     * @return mixed
     */
    public function saveVisitedPage($instance, $visitPageData);

    /**
     * @return mixed
     */
    public function fileDownloaded();
}
