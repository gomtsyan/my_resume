<?php

namespace App\Http\Controllers;

use App\Contracts\VisitLogger;
use App\Repositories\Contracts\PagesRepository;
use App\Repositories\Contracts\PortfolioRepository;

class PortfolioController extends BaseController
{
    /**
     * @var PortfolioRepository
     */
    protected $portfolioRepo;

    /**
     * PortfolioController constructor.
     * @param PagesRepository $pagesRepo
     * @param VisitLogger $visitLogger
     * @param PortfolioRepository $portfolioRepo
     */
    public function __construct(
        PagesRepository $pagesRepo,
        VisitLogger $visitLogger,
        PortfolioRepository $portfolioRepo
    ) {
        parent::__construct($pagesRepo, $visitLogger);

        $this->portfolioRepo = $portfolioRepo;
        $this->template = config('settings.theme') . '.portfolio.index';
        // Save visit log info.
        $this->visitLogSave();
    }

    /**
     * @return Common\CommonController
     */
    public function index()
    {
        //Page content definition
        $this->content = $this->getViewContent('portfolio.content',
            [
                'portfolios' => $this->getPortfolio()
            ]
        );

        return $this->renderCurrentView();
    }

    /**
     * @param array $columns
     * @return mixed
     */
    protected function getPortfolio($columns = ['*'])
    {
        return $this->portfolioRepo->latest($columns);
    }
}
