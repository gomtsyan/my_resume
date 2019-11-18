<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AboutMeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if ($this->route()->getName() == 'profile.update') {
            return auth()->user()->can('update', 'App\Models\AboutMe');
        } elseif ($this->route()->getName() == 'profile.store') {
            return auth()->user()->can('create', 'App\Models\AboutMe');
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
            'title' => 'required|max:255',
            'text' => 'required'
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

        $validator->sometimes('cv', 'max:2048', function ($input) {

            if (!empty($input->cv)) {
                return true;
            }

            return false;
        });

        $validator->sometimes('img', 'required', function ($input) {

            if ($this->route()->getName() == 'profile.store') {
                return true;
            }

            return false;
        });

        $validator->sometimes('cv', 'required', function ($input) {

            if ($this->route()->getName() == 'profile.store') {
                return true;
            }

            return false;
        });

        return $validator;
    }
}
