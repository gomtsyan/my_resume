<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if ($this->route()->getName() == 'pages.update') {
            return auth()->user()->can('update', 'App\Models\Page');
        } elseif ($this->route()->getName() == 'pages.store') {
            return auth()->user()->can('create', 'App\Models\Page');
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
            'title' => 'required|max:255',
            'path' => 'required|max:255',
            'order' => 'required'
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

            if ($this->route()->getName() == 'pages.store') {
                return true;
            }

            return false;
        });

        return $validator;
    }
}
