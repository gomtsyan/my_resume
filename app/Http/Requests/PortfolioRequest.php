<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PortfolioRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if ($this->route()->getName() == 'portfolio.update') {
            return auth()->user()->can('update', 'App\Models\Portfolio');
        } elseif ($this->route()->getName() == 'portfolio.store') {
            return auth()->user()->can('create', 'App\Models\Portfolio');
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
            'text' => 'required',
            'framework' => 'required|max:255',
            'link' => 'required|max:255',
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

            if ($this->route()->getName() == 'portfolio.store') {
                return true;
            }

            return false;
        });

        return $validator;
    }
}
