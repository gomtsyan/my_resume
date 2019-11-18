<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ExperienceRequest;
use App\Models\Experience;
use App\Repositories\Contracts\ContactMeRepository;
use App\Repositories\Contracts\ExperiencesRepository;
use App\Traits\Authorizable;

class ExperienceController extends AdminController
{
    use Authorizable;

    /**
     * @var $experiencesRepo
     */
    protected $experiencesRepo;

    /**
     * ExperienceController constructor.
     * @param ContactMeRepository $contactMeRepo
     * @param ExperiencesRepository $experiencesRepo
     */
    public function __construct(
        ContactMeRepository $contactMeRepo,
        ExperiencesRepository $experiencesRepo
    ) {
        parent::__construct($contactMeRepo);

        $this->experiencesRepo = $experiencesRepo;
        $this->policyModel = 'App\Models\Experience';
        $this->redirectPath = '/admin/experiences/';
        $this->template = config('settings.admin_theme') . '.experiences.index';
        $this->subTitle = __('admin.experience_management');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \App\Http\Controllers\Common\CommonController
     */
    public function index()
    {
        $this->title = __('admin.experiences');
        $experiences = $this->getExperiences();
        $fieldNames = $this->getFieldNames($experiences);

        //Page content definition
        $this->content = $this->getViewContent('experiences.content',
            [
                'fieldNames' => $fieldNames,
                'experiences' => $experiences,
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
        $this->title = __('admin.create_job');

        //Page content definition
        $this->content = $this->getViewContent('experiences.experience_form',
            [
                'title' => $this->title
            ]
        );

        return $this->renderCurrentView();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ExperienceRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ExperienceRequest $request)
    {
        $result = $this->createData($this->experiencesRepo, $request);

        if ($this->isErrorExist($result)) {
            return back()->with($result);
        }

        return redirect($this->redirectPath)->with($result);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Experience $experience
     * @return \App\Http\Controllers\Common\CommonController
     */
    public function edit(Experience $experience)
    {
        $this->title = __('admin.edit_job');

        //Page content definition
        $this->content = $this->getViewContent('experiences.experience_form',
            [
                'title' => $this->title,
                'job' => $experience
            ]
        );

        return $this->renderCurrentView();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ExperienceRequest $request
     * @param Experience $experience
     * @return \Illuminate\Http\Response
     */
    public function update(ExperienceRequest $request, Experience $experience)
    {
        $result = $this->updateData($this->experiencesRepo, $request, $experience);

        if ($this->isErrorExist($result)) {
            return back()->with($result);
        }

        return redirect($this->redirectPath)->with($result);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Experience $experience
     * @return \Illuminate\Http\Response
     */
    public function destroy(Experience $experience)
    {
        $result = $this->deleteData($this->experiencesRepo, $experience);

        echo json_encode($result);
        die;
    }

    /**
     * @return mixed
     */
    protected function getExperiences()
    {
        return $this->experiencesRepo->all(['id', 'position', 'company', 'location', 'start_date', 'end_date']);
    }
}
