<?php

namespace App\Repositories;

use App\Models\User;
use app\Repositories\Contracts\UsersRepository;

class EloquentUsersRepository extends EloquentBaseRepository implements UsersRepository
{
    /**
     * EloquentUsersRepository constructor.
     * @param User $model
     */
    public function __construct(User $model)
    {
        $this->model = $model;
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
     * @param $request
     * @return mixed
     */
    public function create($request)
    {
        $data = $this->getCreateData($request);
        $data['password'] = bcrypt($data['password']);

        if ($user = $this->model->create($data)) {
            $this->syncRoles($data, $user);

            return ['success' => __('User added successfully.')];
        }

        return ['error' => __('Something went wrong.')];
    }

    /**
     * @param $request
     * @param $user
     * @return mixed
     */
    public function update($request, $user)
    {
        $data = $this->getUpdateData($request);
        $this->syncRoles($data, $user);
        $user->fill($data);

        if ($user->update()) {
            return ['success' => __('User has been updated.')];
        }

        return ['error' => __('Something went wrong.')];
    }

    /**
     * @param $user
     * @return mixed
     */
    public function delete($user)
    {
        $user->roles()->detach();

        if ($this->model->destroy($user->id)) {
            return ['success' => __('User has been deleted.')];
        }

        return ['error' => __('Something went wrong.')];
    }

    /**
     * @param $data
     * @return bool
     */
    private function isEmpty($data)
    {
        return empty($data);
    }

    /**
     * @param $request
     * @return array
     */
    private function getUpdateData($request)
    {
        $data = $request->except('_token', '_method');

        if ($this->isEmpty($data)) {
            return ['error' => __('Empty Data!')];
        }

        if (isset($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']);
            unset($data['password_confirmation']);
        }

        return $data;
    }

    /**
     * @param $request
     * @return array
     */
    private function getCreateData($request)
    {
        return $request->except('_token', 'password_confirmation');
    }

    /**
     * @param $data
     * @param $user
     */
    private function syncRoles($data, $user)
    {
        if (!isset($data['roles'])) {
            $data['roles'] = [];
        }

        if ($user->roles()->sync($data['roles'])) {
            unset($data['roles']);
        }
    }
}
