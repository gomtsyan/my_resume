<?php

namespace App\Repositories\Contracts;

/**
 * Interface ContactsRepository
 * @package App\Repositories\Contracts
 */
interface ContactsRepository
{
    /**
     * @param array $columns
     * @return mixed
     */
    public function all($columns = array('*'));

    /**
     * @param $request
     * @return mixed
     */
    public function create($request);

    /**
     * @param $request
     * @param $contact
     * @return mixed
     */
    public function update($request, $contact);

    /**
     * @param $contact
     * @return mixed
     */
    public function delete($contact);

    /**
     * @param array $columns
     * @return mixed
     */
    public function getSocialContacts($columns = array('*'));
}
