<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if ($this->route()->getName() == 'roles.update') {
            return auth()->user()->can('update', 'App\Models\Role');
        } elseif ($this->route()->getName() == 'roles.store') {
            return auth()->user()->can('create', 'App\Models\Role');
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
        return [
            'name' => 'required|max:255',
            'slug' => 'required|max:255'
        ];
    }

    /**
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function getValidatorInstance()
    {
        $validator = parent::getValidatorInstance();

        $validator->sometimes('slug', 'unique:roles', function ($input) {

            if ($this->route()->hasParameter('role')) {

                $model = $this->route()->parameter('role');

                return ($model->slug !== $input->slug) && !empty($input->slug);

            }

            return !empty($input->slug);
        });

        return $validator;
    }
}
