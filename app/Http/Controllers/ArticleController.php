<?php

namespace App\Http\Controllers;

use App\Contracts\VisitLogger;
use App\Models\Article;
use App\Repositories\Contracts\ArticleCategoriesRepository;
use App\Repositories\Contracts\ArticlesRepository;
use App\Repositories\Contracts\CommentsRepository;
use App\Repositories\Contracts\PagesRepository;

class ArticleController extends BaseController
{
    /**
     * @var ArticlesRepository
     */
    protected $articlesRepo;

    /**
     * @var ArticleCategoriesRepository
     */
    protected $articleCategoriesRepo;

    /**
     * @var CommentsRepository
     */
    protected $commentsRepo;

    /**
     * ArticleController constructor.
     * @param PagesRepository $pagesRepo
     * @param VisitLogger $visitLogger
     * @param ArticlesRepository $articlesRepo
     * @param ArticleCategoriesRepository $articleCategoriesRepo
     * @param CommentsRepository $commentsRepo
     */
    public function __construct(
        PagesRepository $pagesRepo,
        VisitLogger $visitLogger,
        ArticlesRepository $articlesRepo,
        ArticleCategoriesRepository $articleCategoriesRepo,
        CommentsRepository $commentsRepo
    ) {
        parent::__construct($pagesRepo, $visitLogger);

        $this->articlesRepo = $articlesRepo;
        $this->articleCategoriesRepo = $articleCategoriesRepo;
        $this->commentsRepo = $commentsRepo;
        $this->template = config('settings.theme') . '.articles.index';
    }

    /**
     * Display a listing of the resource.
     *
     * @param $articleCategory
     * @return Common\CommonController
     */
    public function index($articleCategory = null)
    {
        //Page content definition
        $this->content = $this->getViewContent('articles.content',
            [
                'articles' => $this->getArticles($articleCategory),
                'recentArticles' => $this->getRecentArticles(),
                'articleCategories' => $this->getArticleCategories()
            ]
        );

        // Save visit log info.
        $this->visitLogSave();

        return $this->renderCurrentView();
    }

    /**
     * Display the specified resource.
     *
     * @param  Article $article
     * @return Common\CommonController
     */
    public function show(Article $article)
    {
        if(!$article->is_active) {
            abort(404);
        }

        //set head data of page
        $this->setPageHeadData($article->title, $article->short_desc, $article->title);

        //Page content definition
        $this->content = $this->getViewContent('articles.article_content',
            [
                'article' => $article,
                'recentArticles' => $this->getRecentArticles(),
                'articleCategories' => $this->getArticleCategories()
            ]
        );

        // Save visit log info.
        $this->visitLogSave($article->slug);

        return $this->renderCurrentView();
    }

    /**
     * @param $articleCategory
     * @return mixed
     */
    protected function getArticles($articleCategory)
    {
        return $this->articlesRepo->get($articleCategory);
    }

    /**
     * @return mixed
     */
    protected function getRecentArticles()
    {
        return $this->articlesRepo->getRecent();
    }

    /**
     * @return mixed
     */
    protected function getArticleCategories()
    {
        return $this->articleCategoriesRepo->all(['id', 'title', 'slug']);
    }

    /**
     * @param null $additionalData
     * @return array
     */
    protected function getVisitedPageData($additionalData = null)
    {
        $data = parent::getVisitedPageData($additionalData);

        return array_merge($data, ['additional_data' => $additionalData]);
    }
}
