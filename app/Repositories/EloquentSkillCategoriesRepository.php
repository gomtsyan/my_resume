<?php

namespace App\Repositories;

use App\Models\SkillCategory;
use app\Repositories\Contracts\SkillCategoriesRepository;

class EloquentSkillCategoriesRepository extends EloquentBaseRepository implements SkillCategoriesRepository
{
    /**
     * EloquentSkillCategoriesRepository constructor.
     * @param SkillCategory $model
     */
    public function __construct(SkillCategory $model)
    {
        $this->model = $model;
    }
}
