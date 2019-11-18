<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\LanguageSkillRequest;
use App\Models\LanguageSkill;
use App\Repositories\Contracts\ContactMeRepository;
use App\Repositories\Contracts\LanguageSkillsRepository;
use App\Traits\Authorizable;

class LanguageSkillController extends AdminController
{
    use Authorizable;

    /**
     * @var $languageSkillsRepo
     */
    protected $languageSkillsRepo;

    /**
     * LanguageSkillController constructor.
     * @param ContactMeRepository $contactMeRepo
     * @param LanguageSkillsRepository $languageSkillsRepo
     */
    public function __construct(
        ContactMeRepository $contactMeRepo,
        LanguageSkillsRepository $languageSkillsRepo
    ) {
        parent::__construct($contactMeRepo);

        $this->languageSkillsRepo = $languageSkillsRepo;
        $this->policyModel = 'App\Models\LanguageSkill';
        $this->redirectPath = '/admin/skills/languages';
        $this->template = config('settings.admin_theme') . '.language_skills.index';
        $this->subTitle = __('admin.language_skills_management');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \App\Http\Controllers\Common\CommonController
     */
    public function index()
    {
        $this->title = __('admin.language_skills');
        $languageSkills = $this->getLanguageSkills();
        $fieldNames = $this->getFieldNames($languageSkills);

        //Page content definition
        $this->content = $this->getViewContent('language_skills.content',
            [
                'fieldNames' => $fieldNames,
                'languageSkills' => $languageSkills,
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
        $this->title = __('admin.create_language_skill');

        //Page content definition
        $this->content = $this->getViewContent('language_skills.language_skill_form',
            [
                'title' => $this->title
            ]
        );

        return $this->renderCurrentView();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\LanguageSkillRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LanguageSkillRequest $request)
    {
        $result = $this->createData($this->languageSkillsRepo, $request);

        if ($this->isErrorExist($result)) {
            return back()->with($result);
        }

        return redirect($this->redirectPath)->with($result);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  LanguageSkill $language
     * @return \App\Http\Controllers\Common\CommonController
     */
    public function edit(LanguageSkill $language)
    {
        $this->title = __('admin.edit_language_skill'). '-' . $language->name;

        //Page content definition
        $this->content = $this->getViewContent('language_skills.language_skill_form',
            [
                'title' => $this->title,
                'language' => $language
            ]
        );

        return $this->renderCurrentView();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\LanguageSkillRequest  $request
     * @param  LanguageSkill $language
     * @return \Illuminate\Http\Response
     */
    public function update(LanguageSkillRequest $request, LanguageSkill $language)
    {
        $result = $this->updateData($this->languageSkillsRepo, $request, $language);

        if ($this->isErrorExist($result)) {
            return back()->with($result);
        }

        return redirect($this->redirectPath)->with($result);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  LanguageSkill $language
     * @return \Illuminate\Http\Response
     */
    public function destroy(LanguageSkill $language)
    {
        $result = $this->deleteData($this->languageSkillsRepo, $language);

        echo json_encode($result);
        die;
    }

    /**
     * @return mixed
     */
    protected function getLanguageSkills()
    {
        return $this->languageSkillsRepo->all(['id', 'name', 'rating', 'max_rating', 'order']);
    }
}
