<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\PortfolioRequest;
use App\Models\Portfolio;
use App\Repositories\Contracts\ContactMeRepository;
use App\Repositories\Contracts\PortfolioRepository;
use App\Traits\Authorizable;

class PortfolioController extends AdminController
{
    use Authorizable;

    /**
     * @var $portfolioRepo
     */
    protected $portfolioRepo;

    /**
     * PortfolioController constructor.
     * @param ContactMeRepository $contactMeRepo
     * @param PortfolioRepository $portfolioRepo
     */
    public function __construct(
        ContactMeRepository $contactMeRepo,
        PortfolioRepository $portfolioRepo
    ) {
        parent::__construct($contactMeRepo);

        $this->portfolioRepo = $portfolioRepo;
        $this->policyModel = 'App\Models\Portfolio';
        $this->redirectPath = '/admin/page/portfolio';
        $this->template = config('settings.admin_theme') . '.portfolio.index';
        $this->subTitle = __('admin.portfolio_management');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \App\Http\Controllers\Common\CommonController
     */
    public function index()
    {
        $this->title = __('admin.portfolios');
        $portfolios = $this->getPortfolios();
        $fieldNames = $this->getFieldNames($portfolios);

        //Page content definition
        $this->content = $this->getViewContent('portfolio.content',
            [
                'fieldNames' => $fieldNames,
                'portfolios' => $portfolios,
                'title' => $this->title
            ]
        );

        return $this->renderCurrentView();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \App\Http\Controllers\Common\CommonController
     */
    public function create()
    {
        $this->title = __('admin.create_portfolio');

        //Page content definition
        $this->content = $this->getViewContent('portfolio.portfolio_form',
            [
                'title' => $this->title
            ]
        );

        return $this->renderCurrentView();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  PortfolioRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(PortfolioRequest $request)
    {
        $result = $this->createData($this->portfolioRepo, $request);

        if ($this->isErrorExist($result)) {
            return back()->with($result);
        }

        return redirect($this->redirectPath)->with($result);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Portfolio $portfolio
     * @return \App\Http\Controllers\Common\CommonController
     */
    public function edit(Portfolio $portfolio)
    {
        $this->title = __('admin.edit_portfolio');

        //Page content definition
        $this->content = $this->getViewContent('portfolio.portfolio_form',
            [
                'title' => $this->title,
                'portfolio' => $portfolio
            ]
        );

        return $this->renderCurrentView();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  PortfolioRequest $request
     * @param  Portfolio $portfolio
     * @return \Illuminate\Http\Response
     */
    public function update(PortfolioRequest $request, Portfolio $portfolio)
    {
        $result = $this->updateData($this->portfolioRepo, $request, $portfolio);

        if ($this->isErrorExist($result)) {
            return back()->with($result);
        }

        return redirect($this->redirectPath)->with($result);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Portfolio $portfolio
     * @return \Illuminate\Http\Response
     */
    public function destroy(Portfolio $portfolio)
    {
        $result = $this->deleteData($this->portfolioRepo, $portfolio);

        echo json_encode($result);
        die;
    }

    /**
     * @return mixed
     */
    protected function getPortfolios()
    {
        return $this->portfolioRepo->paginate(
            config('settings.admin_portfolios_count'),
            ['id', 'title', 'framework', 'link', 'img']
        );
    }
}
