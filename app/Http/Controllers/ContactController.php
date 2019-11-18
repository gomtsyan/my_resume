<?php

namespace App\Http\Controllers;

use App\Contracts\VisitLogger;
use App\Http\Requests\ContactMeRequest;
use App\Mail\ContactMe;
use App\Repositories\Contracts\ContactMeRepository;
use App\Repositories\Contracts\ContactsRepository;
use App\Repositories\Contracts\PagesRepository;
use Illuminate\Support\Facades\Mail;

class ContactController extends BaseController
{
    /**
     * @var ContactMeRepository
     */
    protected $contactMeRepo;

    /**
     * ContactController constructor.
     * @param PagesRepository $pagesRepo
     * @param VisitLogger $visitLogger
     * @param ContactsRepository $contactsRepo
     * @param ContactMeRepository $contactMeRepo
     */
    public function __construct(
        PagesRepository $pagesRepo,
        VisitLogger $visitLogger,
        ContactsRepository $contactsRepo,
        ContactMeRepository $contactMeRepo
    ) {
        parent::__construct($pagesRepo, $visitLogger);

        $this->contactsRepo = $contactsRepo;
        $this->contactMeRepo = $contactMeRepo;
        $this->template = config('settings.theme') . '.contact.index';
        // Save visit log info.
        $this->visitLogSave();
    }

    /**
     * @return Common\CommonController
     */
    public function index()
    {
        //Page content definition
        $this->content = $this->getViewContent('contact.content',
            [
                'contacts' => $this->getContacts()
            ]);

        return $this->renderCurrentView();
    }

    /**
     * @param ContactMeRequest $request
     * @return $this
     */
    public function contactMe(ContactMeRequest $request)
    {
        if ($request->isMethod('post')) {
            $data = $this->getRequestData($request);
            $this->sendMail($data);

            if ($this->saveMail($request)) {
                logger('user contact me', $data);

                return back()->with('status', __('app.email_sent'));
            }

            return back()->with('error', __('app.something_went_wrong'));
        }
    }

    /**
     * @param $data
     */
    protected function sendMail($data)
    {
        Mail::send(new ContactMe($data));
    }

    /**
     * @param $request
     * @return mixed
     */
    protected function saveMail($request)
    {
        return $this->contactMeRepo->create($request);
    }

    /**
     * @return mixed
     */
    protected function getContacts()
    {
        return $this->contactsRepo->all(['name', 'value', 'icon', 'is_social']);
    }

    /**
     * @param $request
     * @return mixed
     */
    protected function getRequestData($request)
    {
        return $request->except('_method');
    }
}
