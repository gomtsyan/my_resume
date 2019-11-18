<?php

namespace App\Repositories;

use App\Models\Permission;
use app\Repositories\Contracts\PermissionsRepository;

class EloquentPermissionsRepository extends EloquentBaseRepository implements PermissionsRepository
{
    /**
     * EloquentPermissionsRepository constructor.
     * @param Permission $model
     */
    public function __construct(Permission $model)
    {
        $this->model = $model;
    }
}
