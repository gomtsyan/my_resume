<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if ($this->route()->getName() == 'settings.update') {
            return auth()->user()->can('update', 'App\Models\Setting');
        } elseif ($this->route()->getName() == 'settings.store') {
            return auth()->user()->can('create', 'App\Models\Setting');
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
            //
        ];
    }

    /**
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function getValidatorInstance()
    {
        $validator = parent::getValidatorInstance();

        $validator->sometimes(['name', 'key', 'value', 'type'], 'required|max:255', function ($input) {

            if (!$this->ajax()) {
                return true;
            }

            return false;
        });

        return $validator;
    }
}
