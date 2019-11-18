<?php

namespace App\Repositories;

use App\Models\Role;
use app\Repositories\Contracts\RolesRepository;

class EloquentRolesRepository extends EloquentBaseRepository implements RolesRepository
{
    /**
     * EloquentRolesRepository constructor.
     * @param Role $model
     */
    public function __construct(Role $model)
    {
        $this->model = $model;
    }

    /**
     * @param $request
     * @return array
     */
    public function changePermissions($request)
    {
        $data = $this->getRequestData($request);
        $roles = $this->model->get();

        if ($roles) {
            foreach ($roles as $role) {
                if (isset($data[$role->id])) {

                    $role->savePermissions($data[$role->id]);

                } else {
                    $role->savePermissions([]);
                }
            }
        }

        return ['success' => __('admin.permission_updated')];
    }
}
