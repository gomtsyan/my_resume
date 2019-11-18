<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EducationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if ($this->route()->getName() == 'education.update') {
            return auth()->user()->can('update', 'App\Models\Education');
        } elseif ($this->route()->getName() == 'education.store') {
            return auth()->user()->can('create', 'App\Models\Education');
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
            'institution' => 'required|max:255',
            'degree' => 'required|max:255',
            'specialization' => 'required|max:255',
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
