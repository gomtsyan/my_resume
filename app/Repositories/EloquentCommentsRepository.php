<?php

namespace App\Repositories;

use App\Models\Comment;
use app\Repositories\Contracts\CommentsRepository;

class EloquentCommentsRepository extends EloquentBaseRepository implements CommentsRepository
{
    /**
     * EloquentCommentsRepository constructor.
     * @param Comment $model
     */
    public function __construct(Comment $model)
    {
        $this->model = $model;
    }

    /**
     * @param $request
     * @return mixed
     */
    public function create($request)
    {
        $data = $this->getRequestData($request);
        $user = auth()->user();

        //If user is authenticated saving user data
        if ($user) {
            $data['user_id'] = $user->id;
            $data['user_name'] = $user->name;
            $data['email'] = $user->email;
        }

        if ($this->model->create($data)) {
            return ['comment_status_success' => __('admin.comment_added')];
        }

        return ['error' => __('admin.something_went_wrong')];

    }

    /**
     * @param $comment
     * @return mixed
     */
    public function delete($comment)
    {
        $commentsGroup = $this->getCommentsGroupByArticleId($comment->article_id);
        $result = $this->deleteComments($commentsGroup, $comment->id);

        if ($result) {
            return ['success' => __('admin.comment_deleted')];
        }

        return ['error' => __('admin.something_went_wrong')];
    }

    /**
     * @param $commentsGroup
     * @param $commentId
     * @return bool
     */
    protected function deleteComments($commentsGroup, $commentId)
    {
        foreach ($commentsGroup as $parent_id => $comments) {
            if ($parent_id == $commentId) {
                foreach ($comments as $comment) {
                    $this->deleteComments($commentsGroup, $comment->id);
                }
            }
        }

        if ($this->model->destroy($commentId)) {
            return true;
        }

        return false;
    }

    /**
     * @param $articleId
     * @return mixed
     */
    protected function getCommentsGroupByArticleId($articleId)
    {
        return $this->model->whereArticleId($articleId)->get()->groupBy('parent_id');
    }
}
