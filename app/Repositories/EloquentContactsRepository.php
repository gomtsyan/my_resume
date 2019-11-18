<?php

namespace App\Repositories;

use App\Models\Contact;
use app\Repositories\Contracts\ContactsRepository;

class EloquentContactsRepository extends EloquentBaseRepository implements ContactsRepository
{
    /**
     * EloquentContactsRepository constructor.
     * @param Contact $model
     */
    public function __construct(Contact $model)
    {
        $this->model = $model;
    }

    /**
     * @param array $columns
     * @return mixed
     */
    public function getSocialContacts($columns = array('*'))
    {
        return $this->model->social()->get($columns);
    }
}
