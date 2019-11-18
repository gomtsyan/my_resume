<?php

namespace App\Http\Controllers\Admin;

use App\Models\Permission;
use App\Repositories\Contracts\ContactMeRepository;
use App\Repositories\Contracts\PermissionsRepository;
use App\Repositories\Contracts\RolesRepository;
use App\Traits\Authorizable;
use Illuminate\Http\Request;

class PrivilegeController extends AdminController
{
    use Authorizable;

    /**
     * @var PermissionsRepository
     */
    protected $permissionsRepo;

    /**
     * @var RolesRepository
     */
    protected $rolesRepo;

    /**
     * PrivilegeController constructor.
     * @param ContactMeRepository $contactMeRepo
     * @param PermissionsRepository $permissionsRepo
     * @param RolesRepository $rolesRepo
     */
    public function __construct(
        ContactMeRepository $contactMeRepo,
        PermissionsRepository $permissionsRepo,
        RolesRepository $rolesRepo
    ) {
        parent::__construct($contactMeRepo);

        $this->permissionsRepo = $permissionsRepo;
        $this->rolesRepo = $rolesRepo;
        $this->policyModel = 'App\Models\Permission';
        $this->template = config('settings.admin_theme') . '.privileges.index';
        $this->title = __('admin.privileges');
        $this->subTitle = __('admin.user_access_control');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \App\Http\Controllers\Common\CommonController
     */
    public function index()
    {
        $permissions = $this->getPermissions();
        $permissionNames = $this->getPermissionNames($permissions);

        //Page content definition
        $this->content = $this->getViewContent('privileges.content',
            [
                'permissions' => $permissions,
                'permissionNames' => $permissionNames,
                'roles' => $this->getRoles()
            ]
        );

        return $this->renderCurrentView();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $result = $this->rolesRepo->changePermissions($request);

        return back()->with($result);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Permission $privilege
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $privilege)
    {
        $result = $this->deleteData($this->permissionsRepo, $privilege);

        echo json_encode($result);
        die;
    }

    /**
     * @return mixed
     */
    protected function getPermissions()
    {
        return $this->permissionsRepo->all();
    }

    /**
     * @return mixed
     */
    protected function getRoles()
    {
        return $this->rolesRepo->all();
    }

    /**
     * @param $permissions
     * @return mixed
     */
    protected function getPermissionNames($permissions)
    {
        return $permissions->reduce(function ($returnData, $item) {

            if (!isset($item)) {
                return [];
            }

            $name = explode(' ', $item->name);

            $returnData[$name[1]][] = $item->id ?? '';

            return $returnData;

        }, []);
    }
}
