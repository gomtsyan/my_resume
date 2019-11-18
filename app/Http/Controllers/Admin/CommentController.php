<?php

namespace App\Http\Controllers\Admin;

use App\Models\Comment;
use App\Repositories\Contracts\CommentsRepository;
use App\Repositories\Contracts\ContactMeRepository;
use App\Traits\Authorizable;

class CommentController extends AdminController
{
    use Authorizable;

    /**
     * @var CommentsRepository
     */
    protected $commentsRepo;

    /**
     * CommentController constructor.
     * @param ContactMeRepository $contactMeRepo
     * @param CommentsRepository $commentsRepo
     */
    public function __construct(
        ContactMeRepository $contactMeRepo,
        CommentsRepository $commentsRepo
    ) {
        parent::__construct($contactMeRepo);

        $this->commentsRepo = $commentsRepo;
        $this->policyModel = 'App\Models\Comment';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Comment $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        $result = $this->commentsRepo->delete($comment);

        echo json_encode($result);
        die;
    }
}
