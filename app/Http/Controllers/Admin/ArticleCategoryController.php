<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ArticleCategoryRequest;
use App\Models\ArticleCategory;
use App\Repositories\Contracts\ArticleCategoriesRepository;
use App\Repositories\Contracts\ContactMeRepository;
use App\Traits\Authorizable;

class ArticleCategoryController extends AdminController
{
    use Authorizable;

    /**
     * @var $usersRepo
     */
    protected $articleCategoriesRepo;

    /**
     * ArticleCategoryController constructor.
     * @param ContactMeRepository $contactMeRepo
     * @param ArticleCategoriesRepository $articleCategoriesRepo
     */
    public function __construct(
        ContactMeRepository $contactMeRepo,
        ArticleCategoriesRepository $articleCategoriesRepo
    ) {
        parent::__construct($contactMeRepo);

        $this->articleCategoriesRepo = $articleCategoriesRepo;
        $this->policyModel = 'App\Models\ArticleCategory';
        $this->redirectPath = '/admin/article/category';
        $this->template = config('settings.admin_theme') . '.article_categories.index';
        $this->subTitle = __('admin.article_category_management');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \App\Http\Controllers\Common\CommonController
     */
    public function index()
    {
        $this->title = __('admin.article_categories');
        $articleCategories = $this->getArticleCategories();
        $fieldNames = $this->getFieldNames($articleCategories);

        //Page content definition
        $this->content = $this->getViewContent('article_categories.content',
            [
                'fieldNames' => $fieldNames,
                'articleCategories' => $articleCategories,
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
        $this->title = __('admin.create_article_category');

        //Page content definition
        $this->content = $this->getViewContent('article_categories.article_category_form',
            [
                'title' => $this->title
            ]
        );

        return $this->renderCurrentView();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ArticleCategoryRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticleCategoryRequest $request)
    {
        $result = $this->createData($this->articleCategoriesRepo, $request);

        if ($this->isErrorExist($result)) {
            return back()->with($result);
        }

        return redirect($this->redirectPath)->with($result);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  ArticleCategory $category
     * @return \App\Http\Controllers\Common\CommonController
     */
    public function edit(ArticleCategory $category)
    {
        $this->title = __('admin.edit_article_category');

        //Page content definition
        $this->content = $this->getViewContent('article_categories.article_category_form',
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
     * @param  ArticleCategoryRequest $request
     * @param  ArticleCategory $category
     * @return \Illuminate\Http\Response
     */
    public function update(ArticleCategoryRequest $request, ArticleCategory $category)
    {
        $result = $this->updateData($this->articleCategoriesRepo, $request, $category);

        if ($this->isErrorExist($result)) {
            return back()->with($result);
        }

        return redirect($this->redirectPath)->with($result);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  ArticleCategory $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(ArticleCategory $category)
    {
        $result = $this->deleteData($this->articleCategoriesRepo, $category);

        echo json_encode($result);
        die;
    }

    /**
     * @return mixed
     */
    protected function getArticleCategories()
    {
        return $this->articleCategoriesRepo->all(['id', 'title', 'slug']);
    }
}
