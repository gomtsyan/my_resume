<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if ($this->route()->getName() == 'category.update') {
            return auth()->user()->can('update', 'App\Models\ArticleCategory');
        } elseif ($this->route()->getName() == 'category.store') {
            return auth()->user()->can('create', 'App\Models\ArticleCategory');
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
            'slug' => 'required|max:255',
        ];
    }

    /**
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function getValidatorInstance()
    {
        $validator = parent::getValidatorInstance();

        $validator->sometimes('slug', 'unique:article_categories', function ($input) {

            if ($this->route()->hasParameter('category')) {

                $model = $this->route()->parameter('category');

                return ($model->slug !== $input->slug) && !empty($input->slug);

            }

            return !empty($input->slug);
        });

        return $validator;
    }
}
