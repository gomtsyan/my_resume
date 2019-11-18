<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ArticleRequest;
use App\Models\Article;
use App\Repositories\Contracts\ArticleCategoriesRepository;
use App\Repositories\Contracts\ArticlesRepository;
use App\Repositories\Contracts\ContactMeRepository;
use App\Traits\Authorizable;

class ArticleController extends AdminController
{
    use Authorizable;

    /**
     * @var $contactsRepo
     */
    protected $articlesRepo;

    /**
     * @var $usersRepo
     */
    protected $articleCategoriesRepo;

    /**
     * ArticleController constructor.
     * @param ContactMeRepository $contactMeRepo
     * @param ArticlesRepository $articlesRepo
     * @param ArticleCategoriesRepository $articleCategoriesRepo
     */
    public function __construct(
        ContactMeRepository $contactMeRepo,
        ArticlesRepository $articlesRepo,
        ArticleCategoriesRepository $articleCategoriesRepo
    ) {
        parent::__construct($contactMeRepo);

        $this->articleCategoriesRepo = $articleCategoriesRepo;
        $this->articlesRepo = $articlesRepo;
        $this->policyModel = 'App\Models\Article';
        $this->redirectPath = '/admin/page/blog';
        $this->template = config('settings.admin_theme') . '.articles.index';
        $this->subTitle = __('admin.article_management');
        $this->exceptFields = ['category_id', 'user_id', 'comments'];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \App\Http\Controllers\Common\CommonController
     */
    public function index()
    {
        $this->title = __('admin.articles');
        $articles = $this->getArticles();
        $fieldNames = $this->getFieldNames($articles);

        //Page content definition
        $this->content = $this->getViewContent('articles.content',
            [
                'fieldNames' => $fieldNames,
                'articles' => $articles,
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
        $this->title = __('admin.create_article');

        //Page content definition
        $this->content = $this->getViewContent('articles.article_form',
            [
                'title' => $this->title,
                'categories' => $this->getArticleCategories()
            ]
        );

        return $this->renderCurrentView();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ArticleRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticleRequest $request)
    {
        $result = $this->createData($this->articlesRepo, $request);

        if ($this->isErrorExist($result)) {
            return back()->with($result);
        }

        return redirect($this->redirectPath)->with($result);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Article $article
     * @return \App\Http\Controllers\Common\CommonController
     */
    public function edit(Article $article)
    {
        $this->title = __('admin.edit_article');

        //Page content definition
        $this->content = $this->getViewContent('articles.article_form',
            [
                'title' => $this->title,
                'article' => $article,
                'categories' => $this->getArticleCategories()
            ]
        );

        return $this->renderCurrentView();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ArticleRequest $request
     * @param  Article $article
     * @return \Illuminate\Http\Response
     */
    public function update(ArticleRequest $request, Article $article)
    {
        $result = $this->updateData($this->articlesRepo, $request, $article);

        if ($this->isErrorExist($result)) {
            return back()->with($result);
        }

        return redirect($this->redirectPath)->with($result);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Article $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        $result = $this->deleteData($this->articlesRepo, $article);

        echo json_encode($result);
        die;
    }

    /**
     * @return mixed
     */
    protected function getArticles()
    {
        return $this->articlesRepo->paginate(config('settings.admin_articles_count'),
            ['id', 'title', 'slug', 'img', 'is_active', 'user_id', 'category_id']);
    }

    /**
     * @return mixed
     */
    protected function getArticleCategories()
    {
        return $this->getFormSelectData($this->articleCategoriesRepo->all(['id', 'title']), 'title');
    }
}
