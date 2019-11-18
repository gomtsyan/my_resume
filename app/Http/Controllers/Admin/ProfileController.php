<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\AboutMeRequest;
use App\Models\AboutMe;
use App\Repositories\Contracts\AboutMeRepository;
use App\Repositories\Contracts\ContactMeRepository;
use App\Traits\Authorizable;

class ProfileController extends AdminController
{
    use Authorizable;

    /**
     * @var AboutMeRepository
     */
    protected $aboutMeRepo;

    /**
     * ProfileController constructor.
     * @param ContactMeRepository $contactMeRepo
     * @param AboutMeRepository $aboutMeRepo
     */
    public function __construct(
        ContactMeRepository $contactMeRepo,
        AboutMeRepository $aboutMeRepo
    ) {
        parent::__construct($contactMeRepo);

        $this->aboutMeRepo = $aboutMeRepo;
        $this->policyModel = 'App\Models\AboutMe';
        $this->redirectPath = '/admin/page/profile';
        $this->template = config('settings.admin_theme') . '.profile.index';
        $this->subTitle = __('admin.about_me');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \App\Http\Controllers\Common\CommonController
     */
    public function index()
    {
        $this->title = __('admin.profile');

        //Page content definition
        $this->content = $this->getViewContent('profile.content',
            [
                'aboutMeData' => $this->getAboutMeData(),
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
        $this->title = __('admin.create_profile_page');

        //Page content definition
        $this->content = $this->getViewContent('profile.about_me_form',
            [
                'title' => $this->title
            ]
        );

        return $this->renderCurrentView();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\AboutMeRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(AboutMeRequest $request)
    {
        $result = $this->createData($this->aboutMeRepo, $request);

        if ($this->isErrorExist($result)) {
            return back()->with($result);
        }

        return redirect($this->redirectPath)->with($result);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param AboutMe $profile
     * @return \App\Http\Controllers\Common\CommonController
     */
    public function edit(AboutMe $profile)
    {
        $this->title = __('admin.edit_profile_page');

        //Page content definition
        $this->content = $this->getViewContent('profile.about_me_form',
            [
                'title' => $this->title,
                'profileData' => $profile,
            ]
        );

        return $this->renderCurrentView();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\AboutMeRequest $request
     * @param AboutMe $profile
     * @return \Illuminate\Http\Response
     */
    public function update(AboutMeRequest $request, AboutMe $profile)
    {
        $result = $this->updateData($this->aboutMeRepo, $request, $profile);

        if ($this->isErrorExist($result)) {
            return back()->with($result);
        }

        return redirect($this->redirectPath)->with($result);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  AboutMe $profile
     * @return \Illuminate\Http\Response
     */
    public function destroy(AboutMe $profile)
    {
        $result = $this->deleteData($this->aboutMeRepo, $profile);

        echo json_encode($result);
        die;
    }

    /**
     * @return mixed
     */
    protected function getAboutMeData()
    {
        return $this->aboutMeRepo->first();
    }
}
