<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\PersonalInfoRequest;
use App\Models\PersonalInfo;
use App\Repositories\Contracts\ContactMeRepository;
use App\Repositories\Contracts\PersonalInfoRepository;
use App\Traits\Authorizable;

class PersonalInfoController extends AdminController
{
    use Authorizable;

    /**
     * @var PersonalInfoRepository
     */
    protected $personalInfoRepo;

    /**
     * PersonalInfoController constructor.
     * @param ContactMeRepository $contactMeRepo
     * @param PersonalInfoRepository $personalInfoRepo
     */
    public function __construct(
        ContactMeRepository $contactMeRepo,
        PersonalInfoRepository $personalInfoRepo
    ) {
        parent::__construct($contactMeRepo);

        $this->personalInfoRepo = $personalInfoRepo;
        $this->policyModel = 'App\Models\PersonalInfo';
        $this->redirectPath = '/admin/info/personal';
        $this->template = config('settings.admin_theme') . '.personal_info.index';
        $this->subTitle = __('admin.personal_information_management');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \App\Http\Controllers\Common\CommonController
     */
    public function index()
    {
        $this->title = __('admin.personal_info');

        //Page content definition
        $this->content = $this->getViewContent('personal_info.content',
            [
                'personalInfoData' => $this->getPersonalInfoData(),
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
        $this->title = __('admin.create_personal_information');

        //Page content definition
        $this->content = $this->getViewContent('personal_info.personal_info_form',
            [
                'title' => $this->title
            ]
        );

        return $this->renderCurrentView();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\PersonalInfoRequest
     * @return \Illuminate\Http\Response
     */
    public function store(PersonalInfoRequest $request)
    {
        $result = $this->createData($this->personalInfoRepo, $request);

        if ($this->isErrorExist($result)) {
            return back()->with($result);
        }

        return redirect($this->redirectPath)->with($result);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  PersonalInfo $personal
     * @return \App\Http\Controllers\Common\CommonController
     */
    public function edit(PersonalInfo $personal)
    {
        $this->title = __('admin.edit_personal_information');

        //Page content definition
        $this->content = $this->getViewContent('personal_info.personal_info_form',
            [
                'title' => $this->title,
                'personalInfoData' => $personal,
            ]
        );

        return $this->renderCurrentView();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\PersonalInfoRequest
     * @param  PersonalInfo $personal
     * @return \Illuminate\Http\Response
     */
    public function update(PersonalInfoRequest $request, PersonalInfo $personal)
    {
        $result = $this->updateData($this->personalInfoRepo, $request, $personal);

        if ($this->isErrorExist($result)) {
            return back()->with($result);
        }

        return redirect($this->redirectPath)->with($result);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  PersonalInfo $personal
     * @return \Illuminate\Http\Response
     */
    public function destroy(PersonalInfo $personal)
    {
        $result = $this->deleteData($this->personalInfoRepo, $personal);

        echo json_encode($result);
        die;
    }

    /**
     * @return mixed
     */
    protected function getPersonalInfoData()
    {
        return $this->personalInfoRepo->first();
    }
}
