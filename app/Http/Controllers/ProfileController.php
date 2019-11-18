<?php

namespace App\Http\Controllers;

use App\Contracts\VisitLogger;
use App\Repositories\Contracts\AboutMeRepository;
use App\Repositories\Contracts\PagesRepository;

class ProfileController extends BaseController
{
    /**
     * @var AboutMeRepository
     */
    protected $aboutMeRepo;

    /**
     * ProfileController constructor.
     * @param PagesRepository $pagesRepo
     * @param VisitLogger $visitLogger
     * @param AboutMeRepository $aboutMeRepo
     */
    public function __construct(
        PagesRepository $pagesRepo,
        VisitLogger $visitLogger,
        AboutMeRepository $aboutMeRepo
    ) {
        parent::__construct($pagesRepo, $visitLogger);

        $this->aboutMeRepo = $aboutMeRepo;
        $this->template = config('settings.theme') . '.profile.index';
        // Save visit log info.
        $this->visitLogSave();
    }

    /**
     * @return Common\CommonController
     */
    public function index()
    {
        //Page content definition
        $this->content = $this->getViewContent('profile.content',
            [
                'aboutMe' => $this->getAboutMe()
            ]
        );

        return $this->renderCurrentView();
    }

    /**
     * @return mixed
     */
    protected function getAboutMe()
    {
        return $this->aboutMeRepo->first();
    }
}
