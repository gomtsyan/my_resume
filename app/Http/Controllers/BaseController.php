<?php

namespace App\Http\Controllers;

use App\Contracts\VisitLogger;
use App\Http\Controllers\Common\CommonController;
use App\Repositories\Contracts\PagesRepository;

class BaseController extends CommonController
{
    /**
     * @var VisitLogger
     */
    protected $visitLogger;

    /**
     * @var $pagesRepo
     */
    protected $pagesRepo;

    /**
     * @var $contactsRepo
     */
    protected $contactsRepo;

    /**
     * BaseController constructor.
     * @param PagesRepository $pagesRepo
     * @param VisitLogger $visitLogger
     */
    public function __construct(
        PagesRepository $pagesRepo,
        VisitLogger $visitLogger
    ) {
        $this->pagesRepo = $pagesRepo;
        $this->visitLogger = $visitLogger;
        $this->configKey = 'theme';
    }

    /**
     * @return CommonController
     */
    protected function renderCurrentView()
    {
        $currentPage = $this->getCurrentPage();

        if ($this->pageIsNotAvailable($currentPage)) {
            abort(404);
        }

        $this->setPageHeadData($currentPage->keywords, $currentPage->meta_desc, $currentPage->title);

        if (!$this->isIndexPage()) {
            $this->addHeaderToPage($currentPage);
        }

        return parent::renderCurrentView();
    }

    /**
     * @param $currentPage
     */
    protected function addHeaderToPage($currentPage)
    {
        $header = $this->getViewContent('partials.header', ['pageData' => $currentPage]);
        $this->varsPush('header', $header);
    }

    /**
     * @return bool
     */
    protected function isIndexPage()
    {
        return request()->route()->named('index');
    }

    /**
     * @param $currentPage
     * @return bool
     */
    protected function pageIsNotAvailable($currentPage)
    {
        return !$currentPage || (!$this->isIndexPage() && !$currentPage->is_active);
    }

    /**
     * Different columns are loaded depending on the page
     *
     * @return array
     */
    protected function getColumns()
    {
        $columns = ['keywords', 'meta_desc', 'title'];

        if (!$this->isIndexPage()) {
            $columns = array_merge($columns, ['sub_title', 'img', 'is_active']);
        }

        return $columns;
    }

    /**
     * @return string
     */
    protected function getCurrentControllerName()
    {
        //get current controller with action example (ArticleController@index)
        $controller = class_basename(request()->route()->getAction('controller'));
        //split the string into parts to get the name of the controller
        $controllerParts = explode("Controller", $controller);

        return strtolower($controllerParts[0]);
    }

    /**
     * @return mixed
     */
    protected function getCurrentPage()
    {
        return $this->getPageByName($this->getCurrentControllerName(), $this->getColumns());
    }

    /**
     * @param null $additionalData
     * @return array
     */
    protected function getVisitedPageData($additionalData = null)
    {
        return [
            'page' => $this->getCurrentPage()->title
        ];
    }

    /**
     * Save visit page log data.
     *
     * @param $dataInfo
     */
    protected function visitLogSave($dataInfo = null)
    {
        $visitor = $this->visitLogger->save();

        // Get visited page info for save into db.
        $visitPageData = $this->getVisitedPageData($dataInfo);

        if ($visitor) {
            $visitPageData = array_merge($visitPageData, ['visitor_id' => $visitor->id]);
        }

        $this->visitLogger->saveVisitedPage($visitor, $visitPageData);
    }

    /**
     * @param $value
     * @param array $columns
     * @return mixed
     */
    protected function getPageByName($value, $columns = ['*'])
    {
        return $this->pagesRepo->getPageBy('name', $value, $columns);
    }

    /**
     * @param $keywords
     * @param $metaDesc
     * @param $title
     * @internal param $object
     */
    protected function setPageHeadData($keywords, $metaDesc, $title)
    {
        $this->varsPush('keywords', $keywords);
        $this->varsPush('metaDesc', $metaDesc);
        $this->varsPush('title', $title);
    }
}
