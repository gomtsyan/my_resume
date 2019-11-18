<?php

namespace App\Contracts;

/**
 * Interface Uploader
 * @package App\Contracts
 */
interface AnalyzeData
{
    /**
     * @param $data
     * @return array|mixed
     */
    public function getChartData($data);

    /**
     * @param $data
     * @return array|mixed
     */
    public function getSparklineData($data);

    /**
     * @param $data
     * @return array
     */
    public function getSparklineDataTotals($data);

    /**
     * @return mixed
     */
    public function getCurrentMonthVisitedPagesVisitsCounts();

    /**
     * @return mixed
     */
    public function getVisitedPagesVisitsTotalCounts();

    /**
     * @return mixed
     */
    public function getTotalCounts();
}
