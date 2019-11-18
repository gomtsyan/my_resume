<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SkillRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if ($this->route()->getName() == 'skills.update') {
            return auth()->user()->can('update', 'App\Models\Skill');
        } elseif ($this->route()->getName() == 'skills.store') {
            return auth()->user()->can('create', 'App\Models\Skill');
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
            'category_id' => 'required'
        ];
    }
}
