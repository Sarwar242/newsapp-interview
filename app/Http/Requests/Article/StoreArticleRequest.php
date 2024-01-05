<?php

namespace App\Http\Requests\Article;

use Illuminate\Foundation\Http\FormRequest;

class StoreArticleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        // dd($this);
        return [
            'title'          => ['required', 'string', 'max:255'],
            'category_id'    => ['required'],
            'article'        => ['nullable', 'string'],
            'thumb'          => ['nullable', 'file', 'max:2000'],
            'picture'        => ['nullable', 'file', 'max:2000'],
        ];
    }
}
