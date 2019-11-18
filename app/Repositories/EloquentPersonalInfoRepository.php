<?php

namespace App\Repositories;

use App\Contracts\Uploader;
use App\Models\PersonalInfo;
use app\Repositories\Contracts\PersonalInfoRepository;

class EloquentPersonalInfoRepository extends EloquentBaseRepository implements PersonalInfoRepository
{
    /**
     * EloquentPersonalInfoRepository constructor.
     * @param PersonalInfo $model
     * @param Uploader $uploader
     */
    public function __construct(PersonalInfo $model, Uploader $uploader)
    {
        $this->model = $model;
        $this->uploader = $uploader;
        $this->uploader->imageCropSizes = config('settings.home_avatar_image');
        $this->imageUploadType = $this->uploader->imageUploadTypes['ss'];
        $this->setExceptFields(['img']);
    }
}
