<?php

namespace App\Http\Controllers\Admin;

use App\Models\Visitor;
use App\Repositories\Contracts\ContactMeRepository;
use App\Repositories\Contracts\VisitorsRepository;
use App\Traits\Authorizable;
use Yajra\DataTables\Facades\DataTables;

class VisitorController extends AdminController
{
    use Authorizable;

    /**
     * @var $visitorsRepo
     */
    protected $visitorsRepo;

    /**
     * VisitorController constructor.
     * @param ContactMeRepository $contactMeRepo
     * @param VisitorsRepository $visitorsRepo
     */
    public function __construct(
        ContactMeRepository $contactMeRepo,
        VisitorsRepository $visitorsRepo
    ) {
        parent::__construct($contactMeRepo);

        $this->visitorsRepo = $visitorsRepo;
        $this->policyModel = 'App\Models\Visitor';
        $this->template = config('settings.admin_theme') . '.visitors.index';
        $this->title = __('admin.visitors');
        $this->subTitle = __('admin.visitors_data');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \App\Http\Controllers\Common\CommonController
     */
    public function index()
    {
        $this->title = __('admin.visitors');

        //Page content definition
        $this->content = $this->getViewContent('visitors.content',
            [
                'title' => $this->title
            ]
        );

        return $this->renderCurrentView();
    }

    /**
     * @param Visitor $visitor
     * @return \Illuminate\Http\JsonResponse
     */
    public function visitedPages(Visitor $visitor)
    {
        if (request()->ajax()) {

            $content = $this->getViewContent('visitors.visited_pages',
                [
                    'title' => $this->getTitle($visitor),
                    'pagesData' => $visitor->visitedPages
                ]
            );

            return response()->json(['content' => $content], 200);
        }
    }

    /**
     * @param $visitor
     * @return string
     */
    protected function getTitle($visitor)
    {
        $city = $visitor->city ?? 'City';
        $country_name = $visitor->country_name ?? 'Country Name';
        return $city . '/' . $country_name;
    }

    /**
     * @return mixed
     */
    protected function getVisitors()
    {
        return $this->visitorsRepo->all(
            [
                'id',
                'ip',
                'browser',
                'os',
                'continent_name',
                'country_name',
                'country_flag',
                'region_name',
                'city',
                'latitude',
                'longitude',
                'visit_count',
                'is_download_file',
                'updated_at'
            ]
        );
    }

    /**
     * @return mixed
     */
    public function visitorsList()
    {
        if (request()->ajax()) {
            return DataTables::of($this->getVisitors())->make(true);
        }
    }
}
