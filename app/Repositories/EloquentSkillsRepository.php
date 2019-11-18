<?php

namespace App\Repositories;

use App\Models\Skill;
use app\Repositories\Contracts\SkillsRepository;

class EloquentSkillsRepository extends EloquentBaseRepository implements SkillsRepository
{
    /**
     * EloquentSkillsRepository constructor.
     * @param Skill $model
     */
    public function __construct(Skill $model)
    {
        $this->model = $model;
    }
}
