<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\SkillRequest;
use App\Models\Skill;
use App\Repositories\Contracts\ContactMeRepository;
use App\Repositories\Contracts\SkillCategoriesRepository;
use App\Repositories\Contracts\SkillsRepository;
use App\Traits\Authorizable;

class SkillController extends AdminController
{
    use Authorizable;

    /**
     * @var $languageSkillsRepo
     */
    protected $skillsRepo;

    /**
     * @var $languageSkillsRepo
     */
    protected $skillCategoriesRepo;

    /**
     * SkillController constructor.
     * @param ContactMeRepository $contactMeRepo
     * @param SkillsRepository $skillsRepo
     * @param SkillCategoriesRepository $skillCategoriesRepo
     */
    public function __construct(
        ContactMeRepository $contactMeRepo,
        SkillsRepository $skillsRepo,
        SkillCategoriesRepository $skillCategoriesRepo
    ) {
        parent::__construct($contactMeRepo);

        $this->skillCategoriesRepo = $skillCategoriesRepo;
        $this->skillsRepo = $skillsRepo;
        $this->policyModel = 'App\Models\Skill';
        $this->redirectPath = '/admin/skills';
        $this->template = config('settings.admin_theme') . '.skills.index';
        $this->subTitle = __('admin.skills_management');
        $this->exceptFields = ['category_id'];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \App\Http\Controllers\Common\CommonController
     */
    public function index()
    {
        $this->title = __('admin.skills');
        $skills = $this->getSkills();
        $fieldNames = $this->getFieldNames($skills);

        //Page content definition
        $this->content = $this->getViewContent('skills.content',
            [
                'fieldNames' => $fieldNames,
                'skills' => $skills,
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
        $this->title = __('admin.create_skill');

        //Page content definition
        $this->content = $this->getViewContent('skills.skill_form',
            [
                'title' => $this->title,
                'categories' => $this->getCategories()
            ]
        );

        return $this->renderCurrentView();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  SkillRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(SkillRequest $request)
    {
        $result = $this->createData($this->skillsRepo, $request);

        if ($this->isErrorExist($result)) {
            return back()->with($result);
        }

        return redirect($this->redirectPath)->with($result);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Skill $skill
     * @return \App\Http\Controllers\Common\CommonController
     */
    public function edit(Skill $skill)
    {
        $this->title = __('admin.edit_skill');

        //Page content definition
        $this->content = $this->getViewContent('skills.skill_form',
            [
                'title' => $this->title,
                'skill' => $skill,
                'categories' => $this->getCategories()
            ]
        );

        return $this->renderCurrentView();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  SkillRequest $request
     * @param  Skill $skill
     * @return \Illuminate\Http\Response
     */
    public function update(SkillRequest $request, Skill $skill)
    {
        $result = $this->updateData($this->skillsRepo, $request, $skill);

        if ($this->isErrorExist($result)) {
            return back()->with($result);
        }

        return redirect($this->redirectPath)->with($result);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Skill $skill
     * @return \Illuminate\Http\Response
     */
    public function destroy(Skill $skill)
    {
        $result = $this->deleteData($this->skillsRepo, $skill);

        echo json_encode($result);
        die;
    }

    /**
     * @param $dataObject
     * @return array
     */
    protected function getFieldNames($dataObject)
    {
        $fieldNames = parent::getFieldNames($dataObject);

        array_push($fieldNames, "Category");

        return $fieldNames;
    }

    /**
     * @return mixed
     */
    protected function getCategories()
    {
        return $this->getFormSelectData($this->skillCategoriesRepo->all(['id', 'title']), 'title');
    }

    /**
     * @return mixed
     */
    protected function getSkills()
    {
        return $this->skillsRepo->all(['id', 'title', 'category_id']);
    }
}
