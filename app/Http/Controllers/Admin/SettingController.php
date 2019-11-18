<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\SettingRequest;
use App\Models\Setting;
use App\Repositories\Contracts\ContactMeRepository;
use App\Repositories\Contracts\SettingsRepository;
use App\Traits\Authorizable;

class SettingController extends AdminController
{
    use Authorizable;

    /**
     * @var SettingsRepository
     */
    protected $settingsRepo;

    /**
     * SettingController constructor.
     * @param ContactMeRepository $contactMeRepo
     * @param SettingsRepository $settingsRepo
     */
    public function __construct(
        ContactMeRepository $contactMeRepo,
        SettingsRepository $settingsRepo
    ) {
        parent::__construct($contactMeRepo);

        $this->settingsRepo = $settingsRepo;
        $this->policyModel = 'App\Models\Setting';
        $this->redirectPath = '/admin/settings/';
        $this->template = config('settings.admin_theme') . '.settings.index';
        $this->subTitle = __('admin.site_detail_configuration');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \App\Http\Controllers\Common\CommonController
     */
    public function index()
    {
        $this->title = __('admin.settings');

        //Page content definition
        $this->content = $this->getViewContent('settings.content',
            [
                'settings' => $this->getSettings(),
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
        $this->title = __('admin.create_setting');

        //Page content definition
        $this->content = $this->getViewContent('settings.setting_form',
            [
                'title' => $this->title
            ]
        );

        return $this->renderCurrentView();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  SettingRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(SettingRequest $request)
    {
        $result = $this->createData($this->settingsRepo, $request);

        if ($this->isErrorExist($result)) {
            return back()->with($result);
        }

        return redirect($this->redirectPath)->with($result);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Setting $setting
     * @return \App\Http\Controllers\Common\CommonController
     */
    public function edit(Setting $setting)
    {
        $this->title = __('admin.edit_setting');

        //Page content definition
        $this->content = $this->getViewContent('settings.setting_form',
            [
                'title' => $this->title,
                'setting' => $setting,
            ]
        );

        return $this->renderCurrentView();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  SettingRequest $request
     * @param Setting $setting
     * @return \Illuminate\Http\Response
     */
    public function update(SettingRequest $request, Setting $setting)
    {
        $result = $this->updateData($this->settingsRepo, $request, $setting);

        if ($request->ajax()) {
            return $result;
        }

        if ($this->isErrorExist($result)) {
            return back()->with($result);
        }

        return redirect($this->redirectPath)->with($result);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Setting $setting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Setting $setting)
    {
        $result = $this->deleteData($this->settingsRepo, $setting);

        echo json_encode($result);
        die;
    }

    /**
     * @return mixed
     */
    protected function getSettings()
    {
        return $this->settingsRepo->all();
    }
}
