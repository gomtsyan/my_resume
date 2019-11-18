<?php

namespace App\Repositories;

use App\Contracts\Uploader;
use App\Models\Portfolio;
use app\Repositories\Contracts\PortfolioRepository;

class EloquentPortfolioRepository extends EloquentBaseRepository implements PortfolioRepository
{
    /**
     * EloquentPortfolioRepository constructor.
     * @param Portfolio $model
     * @param Uploader $uploader
     */
    public function __construct(Portfolio $model, Uploader $uploader)
    {
        $this->model = $model;
        $this->uploader = $uploader;
        $this->uploader->imageDirectory = config('settings.portfolio_path');
        $this->uploader->imageCropSizes = config('settings.portfolios_img');
        $this->imageUploadType = $this->uploader->imageUploadTypes['ms'];
        $this->setExceptFields(['img']);
    }
}
