<?php

namespace App\Repositories;

use App\Contracts\Uploader;
use App\Models\Page;
use app\Repositories\Contracts\PagesRepository;

class EloquentPagesRepository extends EloquentBaseRepository implements PagesRepository
{
    /**
     * EloquentPagesRepository constructor.
     * @param Page $model
     * @param Uploader $uploader
     */
    public function __construct(Page $model, Uploader $uploader)
    {
        $this->model = $model;
        $this->uploader = $uploader;
        $this->uploader->imageDirectory = config('settings.menu_path');
        $this->uploader->imageCropSizes = config('settings.pages_img');
        $this->imageUploadType = $this->uploader->imageUploadTypes['ms'];
        $this->setExceptFields(['img']);
    }

    /**
     * @param int $perPage
     * @param array $columns
     * @return mixed
     */
    public function paginate($perPage = 5, $columns = array('*'))
    {
        return $this->model->paginate($perPage, $columns);
    }

    /**
     * @param array $columns
     * @return mixed
     */
    public function getActivePages($columns = array('*'))
    {
        return $this->model->active()->orderBy('order')->get($columns);
    }

    /**
     * @param $attribute
     * @param $value
     * @param array $columns
     * @return mixed
     */
    public function getPageBy($attribute, $value, $columns = array('*'))
    {
        return $this->model->where($attribute, $value)->first($columns);
    }
}
