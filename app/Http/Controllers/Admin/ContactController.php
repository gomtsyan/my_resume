<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use App\Repositories\Contracts\ContactMeRepository;
use App\Repositories\Contracts\ContactsRepository;
use App\Traits\Authorizable;

class ContactController extends AdminController
{
    use Authorizable;

    /**
     * @var $contactsRepo
     */
    protected $contactsRepo;

    /**
     * ContactController constructor.
     * @param ContactMeRepository $contactMeRepo
     * @param ContactsRepository $contactsRepo
     */
    public function __construct(
        ContactMeRepository $contactMeRepo,
        ContactsRepository $contactsRepo
    ) {
        parent::__construct($contactMeRepo);

        $this->contactsRepo = $contactsRepo;
        $this->policyModel = 'App\Models\Contact';
        $this->redirectPath = '/admin/page/contact';
        $this->template = config('settings.admin_theme') . '.contacts.index';
        $this->subTitle = __('admin.contact_management');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \App\Http\Controllers\Common\CommonController
     */
    public function index()
    {
        $this->title = __('admin.contacts');
        $contacts = $this->getContacts();
        $fieldNames = $this->getFieldNames($contacts);

        //Page content definition
        $this->content = $this->getViewContent('contacts.content',
            [
                'fieldNames' => $fieldNames,
                'contacts' => $contacts,
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
        $this->title = __('admin.create_contact');

        //Page content definition
        $this->content = $this->getViewContent('contacts.contact_form',
            [
                'title' => $this->title,
                'icons' => config('settings.fa_icons')
            ]
        );

        return $this->renderCurrentView();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ContactRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContactRequest $request)
    {
        $result = $this->createData($this->contactsRepo, $request);

        if ($this->isErrorExist($result)) {
            return back()->with($result);
        }

        return redirect($this->redirectPath)->with($result);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Contact $contact
     * @return \App\Http\Controllers\Common\CommonController
     */
    public function edit(Contact $contact)
    {
        $this->title = __('admin.edit_contact'). '-' . $contact->name;

        //Page content definition
        $this->content = $this->getViewContent('contacts.contact_form',
            [
                'title' => $this->title,
                'icons' => config('settings.fa_icons'),
                'contact' => $contact
            ]
        );

        return $this->renderCurrentView();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ContactRequest $request
     * @param  Contact $contact
     * @return \Illuminate\Http\Response
     */
    public function update(ContactRequest $request, Contact $contact)
    {
        $result = $this->updateData($this->contactsRepo, $request, $contact);

        if ($this->isErrorExist($result)) {
            return back()->with($result);
        }

        return redirect($this->redirectPath)->with($result);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Contact $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $contact)
    {
        $result = $this->deleteData($this->contactsRepo, $contact);

        echo json_encode($result);
        die;
    }

    /**
     * @return mixed
     */
    protected function getContacts()
    {
        return $this->contactsRepo->all(['id', 'name', 'value', 'icon', 'is_social']);
    }
}
