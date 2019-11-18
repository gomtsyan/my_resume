<?php

namespace App\Repositories;

use App\Contracts\Uploader;
use App\Models\Article;
use app\Repositories\Contracts\ArticlesRepository;

class EloquentArticlesRepository extends EloquentBaseRepository implements ArticlesRepository
{
    /**
     * EloquentArticlesRepository constructor.
     * @param Article $model
     * @param Uploader $uploader
     */
    public function __construct(Article $model, Uploader $uploader)
    {
        $this->model = $model;
        $this->uploader = $uploader;
        $this->uploader->imageDirectory = config('settings.blog_path');
        $this->uploader->imageCropSizes = config('settings.article_image');
        $this->imageUploadType = $this->uploader->imageUploadTypes['ss'];
        $this->setExceptFields(['img']);

    }

    /**
     * @param array $columns
     * @return mixed
     */
    public function getRecent($columns = array('*'))
    {
        return $this->model->active()
            ->latest()
            ->take(config('settings.recent_posts'))
            ->get($columns);
    }

    /**
     * @param $articleCategory
     * @param array $columns
     * @return mixed
     */
    public function get($articleCategory, $columns = array('*'))
    {
        $builder = $this->model->active();

        if ($articleCategory) {
            $builder = $builder->whereCategoryId($articleCategory->id);
        }

        return $builder->latest()->paginate(config('settings.articles_count'), $columns);
    }
}
