<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExperienceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if ($this->route()->getName() == 'experiences.update') {
            return auth()->user()->can('update', 'App\Models\Experience');
        } elseif ($this->route()->getName() == 'experiences.store') {
            return auth()->user()->can('create', 'App\Models\Experience');
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
            'position' => 'required|max:255',
            'company' => 'required|max:255',
            'start_date' => 'required|date_format:Y-m-d'
        ];
    }

    /**
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function getValidatorInstance()
    {
        $validator = parent::getValidatorInstance();

        $validator->sometimes('end_date', 'date_format:Y-m-d', function ($input) {

            if (!empty($input->end_date)) {
                return true;
            }

            return false;
        });

        return $validator;
    }
}
