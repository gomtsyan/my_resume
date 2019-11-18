<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\AnalyzeData;
use App\Repositories\Contracts\ContactMeRepository;

class IndexController extends AdminController
{
    /**
     * @var $analyzeVisits
     */
    protected $analyzeVisits;

    /**
     * IndexController constructor.
     * @param ContactMeRepository $contactMeRepo
     * @param AnalyzeData $analyzeVisits
     */
    public function __construct(
        ContactMeRepository $contactMeRepo,
        AnalyzeData $analyzeVisits
    ) {
        parent::__construct($contactMeRepo);

        $this->analyzeVisits = $analyzeVisits;
        $this->template = config('settings.admin_theme') . '.index.index';
        $this->title = __('admin.dashboard');
        $this->subTitle = __('admin.overview_stats');
    }

    /**
     * @return \App\Http\Controllers\Common\CommonController
     */
    public function index()
    {
        $totalCounts = $this->analyzeVisits->getTotalCounts();
        $totalCounts['messagesCount'] = $this->getTotalMessagesCount();

        //Page content definition
        $this->content = $this->getViewContent('index.content',
            [
                'currentMonthPagesVisitsCounts' => $this->analyzeVisits->getCurrentMonthVisitedPagesVisitsCounts(),
                'pagesVisitsTotalCounts' => $this->analyzeVisits->getVisitedPagesVisitsTotalCounts(),
                'totalCounts' => $totalCounts
            ]
        );

        return $this->renderCurrentView();
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getChartData()
    {
        if (request()->ajax()) {

            $data = request()->all();
            $result = $this->analyzeVisits->getChartData($data);

            return response()->json(['result' => $result], 200);
        }
    }

    /**
     * Get Sparkline Data.
     * @return \Illuminate\Http\JsonResponse
     */
    public function getSparklineData()
    {
        if (request()->ajax()) {

            $data = request()->all();
            $result = $this->analyzeVisits->getSparklineData($data);
            $totalCounts = $this->analyzeVisits->getSparklineDataTotals($data);

            return response()->json(['result' => $result, 'totalCounts' => $totalCounts], 200);
        }
    }

    /**
     * @return mixed
     */
    protected function getTotalMessagesCount()
    {
        return $this->contactMeRepo->all()->count();
    }
}
