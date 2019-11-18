<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\SkillCategoryRequest;
use App\Models\SkillCategory;
use App\Repositories\Contracts\ContactMeRepository;
use App\Repositories\Contracts\SkillCategoriesRepository;
use App\Traits\Authorizable;

class SkillCategoryController extends AdminController
{
    use Authorizable;

    /**
     * @var $languageSkillsRepo
     */
    protected $skillCategoriesRepo;

    /**
     * SkillCategoryController constructor.
     * @param ContactMeRepository $contactMeRepo
     * @param SkillCategoriesRepository $skillCategoriesRepo
     */
    public function __construct(
        ContactMeRepository $contactMeRepo,
        SkillCategoriesRepository $skillCategoriesRepo
    ) {
        parent::__construct($contactMeRepo);

        $this->skillCategoriesRepo = $skillCategoriesRepo;
        $this->policyModel = 'App\Models\SkillCategory';
        $this->redirectPath = '/admin/skills/categories';
        $this->template = config('settings.admin_theme') . '.skill_categories.index';
        $this->subTitle = __('admin.skill_category_management');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \App\Http\Controllers\Common\CommonController
     */
    public function index()
    {
        $this->title = __('admin.skill_categories');
        $skillCategories = $this->getSkillCategories();
        $fieldNames = $this->getFieldNames($skillCategories);

        //Page content definition
        $this->content = $this->getViewContent('skill_categories.content',
            [
                'fieldNames' => $fieldNames,
                'skillCategories' => $skillCategories,
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
        $this->title = __('admin.create_skill_category');

        //Page content definition
        $this->content = $this->getViewContent('skill_categories.skill_category_form',
            [
                'title' => $this->title
            ]
        );

        return $this->renderCurrentView();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  SkillCategoryRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(SkillCategoryRequest $request)
    {
        $result = $this->createData($this->skillCategoriesRepo, $request);

        if ($this->isErrorExist($result)) {
            return back()->with($result);
        }

        return redirect($this->redirectPath)->with($result);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  SkillCategory $category
     * @return \App\Http\Controllers\Common\CommonController
     */
    public function edit(SkillCategory $category)
    {
        $this->title = __('admin.edit_skill_category');

        //Page content definition
        $this->content = $this->getViewContent('skill_categories.skill_category_form',
            [
                'title' => $this->title,
                'category' => $category
            ]
        );

        return $this->renderCurrentView();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  SkillCategoryRequest $request
     * @param  SkillCategory $category
     * @return \Illuminate\Http\Response
     */
    public function update(SkillCategoryRequest $request, SkillCategory $category)
    {
        $result = $this->updateData($this->skillCategoriesRepo, $request, $category);

        if ($this->isErrorExist($result)) {
            return back()->with($result);
        }

        return redirect($this->redirectPath)->with($result);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  SkillCategory $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(SkillCategory $category)
    {
        $result = $this->deleteData($this->skillCategoriesRepo, $category);

        echo json_encode($result);
        die;
    }

    /**
     * @return mixed
     */
    protected function getSkillCategories()
    {
        return $this->skillCategoriesRepo->all(['id', 'title']);
    }
}
