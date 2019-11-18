<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\PageRequest;
use App\Models\Page;
use App\Repositories\Contracts\ContactMeRepository;
use App\Repositories\Contracts\PagesRepository;
use App\Traits\Authorizable;

class PageController extends AdminController
{
    use Authorizable;

    /**
     * @var $pagesRepo
     */
    protected $pagesRepo;

    /**
     * PageController constructor.
     * @param ContactMeRepository $contactMeRepo
     * @param PagesRepository $pagesRepo
     */
    public function __construct(
        ContactMeRepository $contactMeRepo,
        PagesRepository $pagesRepo
    ) {
        parent::__construct($contactMeRepo);

        $this->pagesRepo = $pagesRepo;
        $this->policyModel = 'App\Models\Page';
        $this->redirectPath = '/admin/pages/';
        $this->template = config('settings.admin_theme') . '.pages.index';
        $this->subTitle = __('admin.pages_management');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \App\Http\Controllers\Common\CommonController
     */
    public function index()
    {
        $this->title = __('admin.pages');
        $pages = $this->getPages();
        $fieldNames = $this->getFieldNames($pages);

        //Page content definition
        $this->content = $this->getViewContent('pages.content',
            [
                'fieldNames' => $fieldNames,
                'pages' => $pages,
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
        $this->title = __('admin.create_page');

        //Page content definition
        $this->content = $this->getViewContent('pages.page_form',
            [
                'title' => $this->title,
            ]
        );

        return $this->renderCurrentView();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  PageRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(PageRequest $request)
    {
        $result = $this->createData($this->pagesRepo, $request);

        if ($this->isErrorExist($result)) {
            return back()->with($result);
        }

        return redirect($this->redirectPath)->with($result);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Page $page
     * @return \App\Http\Controllers\Common\CommonController
     */
    public function edit(Page $page)
    {
        $this->title = __('admin.edit_page'). '-' . $page->title;

        //Page content definition
        $this->content = $this->getViewContent('pages.page_form',
            [
                'title' => $this->title,
                'page' => $page
            ]
        );

        return $this->renderCurrentView();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PageRequest $request
     * @param Page $page
     * @return \Illuminate\Http\Response
     */
    public function update(PageRequest $request, Page $page)
    {
        $result = $this->updateData($this->pagesRepo, $request, $page);

        if ($this->isErrorExist($result)) {
            return back()->with($result);
        }

        return redirect($this->redirectPath)->with($result);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Page $page
     * @return \Illuminate\Http\Response
     */
    public function destroy(Page $page)
    {
        $result = $this->deleteData($this->pagesRepo, $page);

        echo json_encode($result);
        die;
    }

    /**
     * @return mixed
     */
    protected function getPages()
    {
        return $this->pagesRepo->paginate(
            config('settings.admin_pages_count'),
            ['id', 'title', 'path', 'img', 'sub_title', 'is_active', 'order']
        );
    }
}
