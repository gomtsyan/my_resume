<?php

namespace App\Http\Controllers;

use App\Contracts\VisitLogger;
use App\Events\PageViewed;
use App\Repositories\Contracts\EducationsRepository;
use App\Repositories\Contracts\ExperiencesRepository;
use App\Repositories\Contracts\LanguageSkillsRepository;
use App\Repositories\Contracts\PagesRepository;
use App\Repositories\Contracts\SkillCategoriesRepository;
use App\Repositories\Contracts\SkillsRepository;
use Illuminate\Support\Arr;

class ResumeController extends BaseController
{
    /**
     * @var EducationsRepository
     */
    protected $educationsRepo;

    /**
     * @var ExperiencesRepository
     */
    protected $experiencesRepo;

    /**
     * @var SkillsRepository
     */
    protected $skillsRepo;

    /**
     * @var SkillCategoriesRepository
     */
    protected $skillCategoriesRepo;

    /**
     * @var LanguageSkillsRepository
     */
    protected $languageSkillsRepo;

    /**
     * ResumeController constructor.
     * @param PagesRepository $pagesRepo
     * @param VisitLogger $visitLogger
     * @param EducationsRepository $educationsRepo
     * @param ExperiencesRepository $experiencesRepo
     * @param SkillsRepository $skillsRepo
     * @param SkillCategoriesRepository $skillCategoriesRepo
     * @param LanguageSkillsRepository $languageSkillsRepo
     */
    public function __construct(
        PagesRepository $pagesRepo,
        VisitLogger $visitLogger,
        EducationsRepository $educationsRepo,
        ExperiencesRepository $experiencesRepo,
        SkillsRepository $skillsRepo,
        SkillCategoriesRepository $skillCategoriesRepo,
        LanguageSkillsRepository $languageSkillsRepo
    ) {
        parent::__construct($pagesRepo, $visitLogger);

        $this->educationsRepo = $educationsRepo;
        $this->experiencesRepo = $experiencesRepo;
        $this->skillCategoriesRepo = $skillCategoriesRepo;
        $this->skillsRepo = $skillsRepo;
        $this->languageSkillsRepo = $languageSkillsRepo;
        $this->template = config('settings.theme') . '.resume.index';
        // Save visit log info.
        $this->visitLogSave();
    }

    /**
     * @return Common\CommonController
     */
    public function index()
    {
        //Get data for page content
        $educations = $this->getEducations();
        $experiences = $this->getExperiences();
        $timeLineEducations = $this->getTimeLineData($educations);
        $timeLineExperiences = $this->getTimeLineData($experiences);

        //Page content definition
        $this->content = $this->getViewContent('resume.content',
            [
                'educations' => $educations,
                'experiences' => $experiences,
                'timeLineEducations' => $timeLineEducations,
                'timeLineExperiences' => $timeLineExperiences,
                'skills' => $this->getSkills(),
                'skillCategories' => $this->getSkillCategories(),
                'languageSkills' => $this->getLanguageSkills()
            ]
        );

        return $this->renderCurrentView();
    }

    /**
     * @return mixed
     */
    protected function getEducations()
    {
        return $this->educationsRepo->all();
    }

    /**
     * @return mixed
     */
    protected function getExperiences()
    {
        return $this->experiencesRepo->all();
    }

    /**
     * @return mixed
     */
    protected function getSkills()
    {
        return $this->skillsRepo->all(['id', 'title', 'category_id']);
    }

    /**
     * @return mixed
     */
    protected function getSkillCategories()
    {
        return $this->skillCategoriesRepo->all(['id', 'title']);
    }

    /**
     * @return mixed
     */
    protected function getLanguageSkills()
    {
        return $this->languageSkillsRepo->all(['name', 'rating', 'max_rating']);
    }

    /**
     * @param $data
     * @return array
     */
    protected function getTimeLineData($data)
    {
        $timeLineData = ['left' => array(), 'right' => array()];

        if (is_object($data)) {

            foreach ($data as $key => $item) {

                if (($key + 1) % 2 == 0) {
                    $timeLineData['left'] = Arr::add($timeLineData['left'], $key, $item);
                } else {
                    $timeLineData['right'] = Arr::add($timeLineData['right'], $key, $item);
                }
            }
        }

        return $timeLineData;
    }
}
