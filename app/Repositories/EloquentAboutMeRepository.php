<?php

namespace App\Repositories;

use App\Contracts\Uploader;
use App\Models\AboutMe;
use app\Repositories\Contracts\AboutMeRepository;

class EloquentAboutMeRepository extends EloquentBaseRepository implements AboutMeRepository
{
    /**
     * EloquentAboutMeRepository constructor.
     * @param AboutMe $model
     * @param Uploader $uploader
     */
    public function __construct(AboutMe $model, Uploader $uploader)
    {
        $this->model = $model;
        $this->uploader = $uploader;
        $this->uploader->imageDirectory = config('settings.profile_path');
        $this->uploader->imageCropSizes = config('settings.profile_image');
        $this->imageUploadType = $this->uploader->imageUploadTypes['ss'];
        $this->setExceptFields(['cv', 'img']);
    }
}
