<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if ($this->route()->getName() == 'blog.update') {
            return auth()->user()->can('update', 'App\Models\Article');
        } elseif ($this->route()->getName() == 'blog.store') {
            return auth()->user()->can('create', 'App\Models\Article');
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
            'slug' => 'required|max:150',
            'user_id' => 'required',
            'category_id' => 'required',
        ];
    }

    /**
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function getValidatorInstance()
    {
        $validator = parent::getValidatorInstance();

        $validator->sometimes('img', 'mimes:jpeg,jpg,png,gif|max:2048', function ($input) {
            return !empty($input->img);
        });

        $validator->sometimes('img', 'required', function ($input) {
            return $this->route()->getName() == 'blog.store';
        });

        $validator->sometimes('slug', 'unique:articles|max:150', function ($input) {

            if ($this->route()->hasParameter('article')) {

                $model = $this->route()->parameter('article');

                return ($model->slug !== $input->slug) && !empty($input->slug);

            }

            return !empty($input->slug);
        });

        return $validator;
    }
}
