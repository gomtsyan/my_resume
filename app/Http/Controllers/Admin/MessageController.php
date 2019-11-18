<?php

namespace App\Http\Controllers\Admin;

use App\Models\ContactMe;
use App\Repositories\Contracts\ContactMeRepository;
use App\Traits\Authorizable;

class MessageController extends AdminController
{
    use Authorizable;

    /**
     * MessageController constructor.
     * @param ContactMeRepository $contactMeRepo
     */
    public function __construct(
        ContactMeRepository $contactMeRepo
    ) {
        parent::__construct($contactMeRepo);

        $this->policyModel = 'App\Models\ContactMe';
        $this->redirectPath = '/admin/messages/';
        $this->template = config('settings.admin_theme') . '.messages.index';
        $this->subTitle = __('admin.my_messages');
        $this->searchRepo = $contactMeRepo;
        $this->searchView = 'messages.messages_list';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \App\Http\Controllers\Common\CommonController
     */
    public function index()
    {
        $this->title = __('admin.messages');

        //Page content definition
        $this->content = $this->getViewContent('messages.content',
            [
                'messages' => $this->getMessages()
            ]
        );

        return $this->renderCurrentView();
    }

    /**
     * Display the specified resource.
     *
     * @param  ContactMe $message
     * @return \Illuminate\Http\Response
     */
    public function show(ContactMe $message)
    {
        $singleMessageContent = $this->getViewContent('messages.single_message',
            [
                'message' => $message
            ]
        );

        if (!$message->is_viewed) {
            if (!$this->setMessageAsViewed($message->id)) {
                echo json_encode(['error' => __('Something went wrong.')]);
                die;
            }
        }

        echo json_encode(['success' => $singleMessageContent]);
        die;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ContactMe $message
     * @return \Illuminate\Http\Response
     */
    public function destroy(ContactMe $message)
    {
        $result = $this->deleteData($this->contactMeRepo, $message);

        echo json_encode($result);
        die;
    }

    /**
     * Make message as viewed.
     * @param $messageId
     * @return mixed
     */
    protected function setMessageAsViewed($messageId)
    {
        return $this->contactMeRepo->updateMessageAsViewed($messageId);
    }

    /**
     * Get all messages.
     * @return mixed
     */
    protected function getMessages()
    {
        return $this->contactMeRepo->paginate(config('settings.admin_messages_count'));
    }
}
