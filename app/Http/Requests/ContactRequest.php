<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if ($this->route()->getName() == 'contact.update') {
            return auth()->user()->can('update', 'App\Models\Contact');
        } elseif ($this->route()->getName() == 'contact.store') {
            return auth()->user()->can('create', 'App\Models\Contact');
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
            'value' => 'required|max:255',
            'icon' => 'required|max:255'
        ];
    }
}
