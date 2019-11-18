<?php

namespace App\Services;

use App\Contracts\AnalyzeData;
use App\Repositories\Contracts\VisitedPagesRepository;
use App\Repositories\Contracts\VisitorsRepository;
use Carbon\Carbon;

class AnalyzeVisits implements AnalyzeData
{
    /**
     * @var $visitorsRepo
     */
    protected $visitorsRepo;

    /**
     * @var $visitedPagesRepo
     */
    protected $visitedPagesRepo;

    /**
     * AnalyzeVisits constructor.
     * @param VisitorsRepository $visitorsRepo
     * @param VisitedPagesRepository $visitedPagesRepo
     */
    public function __construct(
        VisitorsRepository $visitorsRepo,
        VisitedPagesRepository $visitedPagesRepo
    ) {
        $this->visitorsRepo = $visitorsRepo;
        $this->visitedPagesRepo = $visitedPagesRepo;
    }

    /**
     * @param $data
     * @return array|mixed
     */
    public function getChartData($data)
    {
        $result = [];

        if ($data) {
            if ($data['start'] === $data['end']) {
                $result = $this->getVisitorsWhereDate($data['start']);
            } else {
                $result = $this->getVisitorsBetweenDate($data['start'], $data['end']);
            }

            if ($result) {
                $result->transform(function ($items) {
                    return [
                        'visitors' => count($items) ?? 0,
                        'downloads' => $items->where('is_download_file', '1')->count() ?? 0
                    ];
                });
            }
        }

        return $result;
    }

    /**
     * @param $data
     * @return array|mixed
     */
    public function getSparklineData($data)
    {
        $result = $this->getVisitorsBetweenDate($data['start'], $data['end']);

        if ($result) {
            $result->transform(function ($items) {
                return [
                    'weekViews' => $items->sum('visit_count') ?? 0,
                    'weekDownloads' => $items->where('is_download_file', '1')->count() ?? 0
                ];
            });
        }

        return $result;
    }

    /**
     * @param $data
     * @return array
     */
    public function getSparklineDataTotals($data)
    {
        $result = $this->getVisitorsForSparkline($data['start'], $data['end']);

        return [
            'visitsTotalCount' => $result->sum('visit_count') ?? 0,
            'downloadsTotalCount' => $result->where('is_download_file', '1')->count() ?? 0
        ];
    }

    /**
     * @return mixed
     */
    public function getCurrentMonthVisitedPagesVisitsCounts()
    {
        $firstOfMonth = Carbon::now()->firstOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();
        $result = $this->getVisitedPagesBetweenDate($firstOfMonth, $endOfMonth);

        return $this->sumEachCountOfCollection($result);
    }

    /**
     * @return mixed
     */
    public function getVisitedPagesVisitsTotalCounts()
    {
        $result = $this->visitedPagesRepo->getAllVisitedPagesGroupByPage();

        return $this->sumEachCountOfCollection($result);
    }

    /**
     * @return mixed
     */
    public function getTotalCounts()
    {
        $visitors = $this->getAllVisitors();

        return [
            'downloadsCount' => $visitors->where('is_download_file', '1')->count(),
            'viewsCount' => $visitors->sum('visit_count'),
            'visitorsCount' => $visitors->count()
        ];
    }

    /**
     * @param $collection
     * @return mixed
     */
    protected function sumEachCountOfCollection($collection)
    {
        if ($collection) {
            $collection->transform(function ($items) {
                return $items->sum('count');
            });
        }

        return $collection;
    }

    /**
     * @param $from
     * @param $to
     * @return mixed
     */
    protected function getVisitorsForSparkline($from, $to)
    {
        return $this->visitorsRepo->whereBetween([
            Carbon::parse($from)->startOfDay(),
            Carbon::parse($to)->endOfDay()
        ], ['visit_count', 'is_download_file']);
    }

    /**
     * @param $from
     * @param $to
     * @return mixed
     */
    protected function getVisitorsBetweenDate($from, $to)
    {
        return $this->visitorsRepo->whereBetweenGroupByDate([
            Carbon::parse($from)->startOfDay(),
            Carbon::parse($to)->endOfDay()
        ]);
    }

    /**
     * @param $where
     * @return mixed
     */
    protected function getVisitorsWhereDate($where)
    {
        return $this->visitorsRepo->whereGroupByDate($where);
    }

    /**
     * @param $from
     * @param $to
     * @return mixed
     */
    protected function getVisitedPagesBetweenDate($from, $to)
    {
        return $this->visitedPagesRepo->whereBetweenGroupByPage([
            Carbon::parse($from)->startOfDay(),
            Carbon::parse($to)->endOfDay()
        ]);
    }

    /**
     * @return mixed
     */
    protected function getAllVisitors()
    {
        return $this->visitorsRepo->all(
            [
                'visit_count',
                'is_download_file'
            ]
        );
    }
}
