<?php

namespace App\Http\Controllers;

use App\Contracts\VisitLogger;
use App\Http\Requests\CommentRequest;
use App\Repositories\Contracts\CommentsRepository;
use App\Repositories\Contracts\PagesRepository;

class CommentController extends BaseController
{
    /**
     * @var CommentsRepository
     */
    protected $commentsRepo;

    /**
     * CommentController constructor.
     * @param PagesRepository $pagesRepo
     * @param VisitLogger $visitLogger
     * @param CommentsRepository $commentsRepo
     */
    public function __construct(
        PagesRepository $pagesRepo,
        VisitLogger $visitLogger,
        CommentsRepository $commentsRepo
    ) {
        parent::__construct($pagesRepo, $visitLogger);

        $this->commentsRepo = $commentsRepo;
    }

    /**
     * @param CommentRequest $request
     * @return $this
     */
    public function store(CommentRequest $request)
    {
        $result = $this->saveComment($request);

        logger('user added comment', $request->except('_token'));

        return back()->with($result);

    }

    /**
     * @param $request
     * @return mixed
     */
    protected function saveComment($request)
    {
        return $this->commentsRepo->create($request);
    }
}
