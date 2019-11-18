<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if ($this->route()->getName() == 'users.update') {
            return auth()->user()->can('update', 'App\Models\User');
        } elseif ($this->route()->getName() == 'users.store') {
            return auth()->user()->can('create', 'App\Models\User');
        }

        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = $this->route()->parameters()['user']->id ?? '';

        return [
            'name' => 'required|max:255',
            'login' => 'required|max:255|unique:users,login,' . $id,
            'roles' => 'array',
            'email' => 'required|email|max:255|unique:users,email,' . $id,
        ];
    }

    /**
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function getValidatorInstance()
    {
        $validator = parent::getValidatorInstance();

        $validator->sometimes('password', 'required|min:8|confirmed', function ($input) {

            if (!empty($input->password) || (empty($input->password) && $this->route()->getName() != 'users.update')) {

                return true;
            }

            return false;
        });

        return $validator;
    }
}
