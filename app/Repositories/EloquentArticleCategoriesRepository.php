<?php

namespace App\Repositories;

use App\Models\ArticleCategory;
use app\Repositories\Contracts\ArticleCategoriesRepository;

class EloquentArticleCategoriesRepository extends EloquentBaseRepository implements ArticleCategoriesRepository
{
    /**
     * EloquentArticleCategoriesRepository constructor.
     * @param ArticleCategory $model
     */
    public function __construct(ArticleCategory $model)
    {
        $this->model = $model;
    }
}
