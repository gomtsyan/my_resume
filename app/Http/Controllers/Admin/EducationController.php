<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\EducationRequest;
use App\Models\Education;
use App\Repositories\Contracts\ContactMeRepository;
use App\Repositories\Contracts\EducationsRepository;
use App\Traits\Authorizable;

class EducationController extends AdminController
{
    use Authorizable;

    /**
     * @var $educationsRepo
     */
    protected $educationsRepo;

    /**
     * EducationController constructor.
     * @param ContactMeRepository $contactMeRepo
     * @param EducationsRepository $educationsRepo
     */
    public function __construct(
        ContactMeRepository $contactMeRepo,
        EducationsRepository $educationsRepo
    ) {
        parent::__construct($contactMeRepo);

        $this->educationsRepo = $educationsRepo;
        $this->policyModel = 'App\Models\Education';
        $this->redirectPath = '/admin/education/';
        $this->template = config('settings.admin_theme') . '.education.index';
        $this->subTitle = __('admin.education_management');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \App\Http\Controllers\Common\CommonController
     */
    public function index()
    {
        $this->title = __('admin.education');
        $educations = $this->getEducations();
        $fieldNames = $this->getFieldNames($educations);

        //Page content definition
        $this->content = $this->getViewContent('education.content',
            [
                'fieldNames' => $fieldNames,
                'educations' => $educations,
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
        $this->title = __('admin.create_institution');

        //Page content definition
        $this->content = $this->getViewContent('education.education_form',
            [
                'title' => $this->title
            ]
        );

        return $this->renderCurrentView();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  EducationRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(EducationRequest $request)
    {
        $result = $this->createData($this->educationsRepo, $request);

        if ($this->isErrorExist($result)) {
            return back()->with($result);
        }

        return redirect($this->redirectPath)->with($result);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Education $education
     * @return \App\Http\Controllers\Common\CommonController
     */
    public function edit(Education $education)
    {
        $this->title = __('admin.edit_institution');

        //Page content definition
        $this->content = $this->getViewContent('education.education_form',
            [
                'title' => $this->title,
                'institution' => $education
            ]
        );

        return $this->renderCurrentView();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  EducationRequest $request
     * @param  Education $education
     * @return \Illuminate\Http\Response
     */
    public function update(EducationRequest $request, Education $education)
    {
        $result = $this->updateData($this->educationsRepo, $request, $education);

        if ($this->isErrorExist($result)) {
            return back()->with($result);
        }

        return redirect($this->redirectPath)->with($result);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Education $education
     * @return \Illuminate\Http\Response
     */
    public function destroy(Education $education)
    {
        $result = $this->deleteData($this->educationsRepo, $education);

        echo json_encode($result);
        die;
    }

    /**
     * @return mixed
     */
    protected function getEducations()
    {
        return $this->educationsRepo->all([
            'id',
            'institution',
            'degree',
            'specialization',
            'location',
            'start_date',
            'end_date'
        ]);
    }
}
