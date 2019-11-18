<?php

namespace App\Http\Controllers;

use App\Contracts\VisitLogger;
use App\Repositories\Contracts\ContactsRepository;
use App\Repositories\Contracts\PagesRepository;
use App\Repositories\Contracts\PersonalInfoRepository;

class IndexController extends BaseController
{
    /**
     * @var PersonalInfoRepository
     */
    protected $personalInfoRepo;

    /**
     * IndexController constructor.
     * @param PagesRepository $pagesRepo
     * @param VisitLogger $visitLogger
     * @param PersonalInfoRepository $personalInfoRepo
     * @param ContactsRepository $contactsRepo
     */
    public function __construct(
        PagesRepository $pagesRepo,
        VisitLogger $visitLogger,
        PersonalInfoRepository $personalInfoRepo,
        ContactsRepository $contactsRepo
    ) {
        parent::__construct($pagesRepo, $visitLogger);

        $this->personalInfoRepo = $personalInfoRepo;
        $this->contactsRepo = $contactsRepo;
        $this->template = config('settings.theme') . '.index.index';
        // Save visit log info.
        $this->visitLogSave();
    }

    /**
     * @return Common\CommonController
     */
    public function index()
    {
        $this->addNavigationToPage();

        //Page content definition
        $this->content = $this->getViewContent('index.content', [
            'contacts' => $this->getSocialContacts(),
            'personalInfo' => $this->getPersonalInfo()
        ]);

        return $this->renderCurrentView();
    }

    /**
     * Add navigation menu to page
     */
    protected function addNavigationToPage()
    {
        $menu = $this->getMenu();
        //Get navigation content
        $navigation = $this->getViewContent('partials.navigation',
            [
                'items' => $menu->roots()
            ]
        );
        //Add navigation content to vars
        $this->varsPush('navigation', $navigation);
    }

    /**
     * @return mixed
     */
    private function getPersonalInfo()
    {
        return $this->personalInfoRepo->first(['first_name', 'last_name', 'position', 'img']);
    }

    /**
     *
     * @return mixed
     */
    private function getMenu()
    {
        $pages = $this->getActivePages();

        $menuBuilder = \Menu::make('Menu', function ($menuItem) use ($pages) {
            if ($pages && is_object($pages)) {
                foreach ($pages as $page) {
                    if ($page->name != 'index') {
                        $menuItem->add($page->title, $page->path)->data('img', $page->img);
                    }
                }
            }
        });

        return $menuBuilder;
    }

    /**
     * @return mixed
     */
    protected function getActivePages()
    {
        return $this->pagesRepo->getActivePages(['name', 'title', 'path', 'img']);
    }

    /**
     * @return mixed
     */
    protected function getSocialContacts()
    {
        return $this->contactsRepo->getSocialContacts(['name', 'value', 'icon']);
    }
}
