<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Repositories\Contracts\ContactMeRepository;
use App\Repositories\Contracts\RolesRepository;
use App\Repositories\Contracts\UsersRepository;
use App\Traits\Authorizable;

class UserController extends AdminController
{
    use Authorizable;

    /**
     * @var $usersRepo
     */
    protected $usersRepo;

    /**
     * @var $rolesRepo
     */
    protected $rolesRepo;

    /**
     * UserController constructor.
     * @param ContactMeRepository $contactMeRepo
     * @param UsersRepository $usersRepo
     * @param RolesRepository $rolesRepo
     */
    public function __construct(
        ContactMeRepository $contactMeRepo,
        UsersRepository $usersRepo,
        RolesRepository $rolesRepo
    ) {
        parent::__construct($contactMeRepo);

        $this->usersRepo = $usersRepo;
        $this->rolesRepo = $rolesRepo;
        $this->policyModel = 'App\Models\User';
        $this->redirectPath = '/admin/users/';
        $this->template = config('settings.admin_theme') . '.users.index';
        $this->subTitle = __('admin.user_management');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \App\Http\Controllers\Common\CommonController
     */
    public function index()
    {
        $this->title = __('admin.users');
        $users = $this->getUsers();
        $fieldNames = $this->getFieldNames($users);

        //Page content definition
        $this->content = $this->getViewContent('users.content',
            [
                'fieldNames' => $fieldNames,
                'users' => $users,
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
        $this->title = 'admin.create_user';

        //Page content definition
        $this->content = $this->getViewContent('users.user_form',
            [
                'title' => $this->title,
                'roles' => $this->getRoles()
            ]
        );

        return $this->renderCurrentView();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\UserRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $result = $this->createData($this->usersRepo, $request);

        if ($this->isErrorExist($result)) {
            return back()->with($result);
        }

        return redirect($this->redirectPath)->with($result);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  User $user
     * @return \App\Http\Controllers\Common\CommonController
     */
    public function edit(User $user)
    {
        $this->title = __('admin.edit_user'). '-' . $user->name;

        //Page content definition
        $this->content = $this->getViewContent('users.user_form',
            [
                'title' => $this->title,
                'roles' => $this->getRoles(),
                'user' => $user
            ]
        );

        return $this->renderCurrentView();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UserRequest $request
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $user)
    {
        $result = $this->updateData($this->usersRepo, $request, $user);

        if ($this->isErrorExist($result)) {
            return back()->with($result);
        }

        return redirect($this->redirectPath)->with($result);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $result = $this->deleteData($this->usersRepo, $user);

        echo json_encode($result);
        die;
    }

    /**
     * @return mixed
     */
    protected function getUsers()
    {
        return $this->usersRepo->paginate(config('settings.admin_users'), ['id', 'name', 'login', 'email']);
    }

    /**
     * @param $dataObject
     * @return array
     */
    protected function getFieldNames($dataObject)
    {
        $fieldNames = parent::getFieldNames($dataObject);

        array_push($fieldNames, "Roles");

        return $fieldNames;
    }

    /**
     * @return mixed
     */
    protected function getRoles()
    {
        return $this->getFormSelectData($this->rolesRepo->all(['id', 'name']), 'name');
    }
}
