<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\RoleRequest;
use App\Models\Role;
use App\Repositories\Contracts\ContactMeRepository;
use App\Repositories\Contracts\RolesRepository;
use App\Traits\Authorizable;

class RoleController extends AdminController
{
    use Authorizable;

    /**
     * @var $rolesRepo
     */
    protected $rolesRepo;

    /**
     * RoleController constructor.
     * @param ContactMeRepository $contactMeRepo
     * @param RolesRepository $rolesRepo
     */
    public function __construct(
        ContactMeRepository $contactMeRepo,
        RolesRepository $rolesRepo
    ) {
        parent::__construct($contactMeRepo);

        $this->rolesRepo = $rolesRepo;
        $this->policyModel = 'App\Models\Role';
        $this->redirectPath = '/admin/roles';
        $this->template = config('settings.admin_theme') . '.roles.index';
        $this->subTitle = __('admin.roles_management');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \App\Http\Controllers\Common\CommonController
     */
    public function index()
    {
        $this->title = __('admin.roles');
        $roles = $this->getRoles();
        $fieldNames = $this->getFieldNames($roles);

        //Page content definition
        $this->content = $this->getViewContent('roles.content',
            [
                'fieldNames' => $fieldNames,
                'roles' => $roles,
                'title' => $this->title
            ]
        );

        return $this->renderCurrentView();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \App\Http\Controllers\Common\CommonController
     */
    public function create()
    {
        $this->title = __('admin.create_role');

        //Page content definition
        $this->content = $this->getViewContent('roles.role_form',
            [
                'title' => $this->title
            ]
        );

        return $this->renderCurrentView();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  RoleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request)
    {
        $result = $this->createData($this->rolesRepo, $request);

        if ($this->isErrorExist($result)) {
            return back()->with($result);
        }

        return redirect($this->redirectPath)->with($result);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Role $role
     * @return \App\Http\Controllers\Common\CommonController
     */
    public function edit(Role $role)
    {
        $this->title = __('admin.edit_role');

        //Page content definition
        $this->content = $this->getViewContent('roles.role_form',
            [
                'title' => $this->title,
                'role' => $role
            ]
        );

        return $this->renderCurrentView();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  RoleRequest  $request
     * @param  Role $role
     * @return \Illuminate\Http\Response
     */
    public function update(RoleRequest $request, Role $role)
    {
        $result = $this->updateData($this->rolesRepo, $request, $role);

        if ($this->isErrorExist($result)) {
            return back()->with($result);
        }

        return redirect($this->redirectPath)->with($result);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Role $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $result = $this->deleteData($this->rolesRepo, $role);

        echo json_encode($result);
        die;
    }

    /**
     * @return mixed
     */
    protected function getRoles()
    {
        return $this->rolesRepo->all(['id', 'name', 'slug']);
    }
}
