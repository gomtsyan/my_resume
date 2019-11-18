<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PersonalInfoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if ($this->route()->getName() == 'personal.update') {
            return auth()->user()->can('update', 'App\Models\PersonalInfo');
        } elseif ($this->route()->getName() == 'personal.store') {
            return auth()->user()->can('create', 'App\Models\PersonalInfo');
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
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'position' => 'required|max:255'
        ];
    }

    /**
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function getValidatorInstance()
    {
        $validator = parent::getValidatorInstance();

        $validator->sometimes('img', 'mimes:jpeg,jpg,png,gif|max:2048', function ($input) {

            if (!empty($input->img)) {
                return true;
            }

            return false;
        });

        $validator->sometimes('img', 'required', function ($input) {

            if ($this->route()->getName() == 'personal_info.store') {
                return true;
            }

            return false;
        });

        return $validator;
    }
}
