<?php

namespace App\Repositories\Contracts;

/**
 * Interface CommentsRepository
 * @package App\Repositories\Contracts
 */
interface CommentsRepository
{
    /**
     * @param $request
     * @return mixed
     */
    public function create($request);

    /**
     * @param $comment
     * @return mixed
     */
    public function delete($comment);
}
