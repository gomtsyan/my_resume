<?php

namespace App\Repositories;

use App\Models\LanguageSkill;
use app\Repositories\Contracts\LanguageSkillsRepository;

class EloquentLanguageSkillsRepository extends EloquentBaseRepository implements LanguageSkillsRepository
{
    /**
     * EloquentLanguageSkillsRepository constructor.
     * @param LanguageSkill $model
     */
    public function __construct(LanguageSkill $model)
    {
        $this->model = $model;
    }

    /**
     * @param array $columns
     * @return mixed
     */
    public function all($columns = array('*'))
    {
        return $this->model->orderBy('order')->get($columns);
    }
}
