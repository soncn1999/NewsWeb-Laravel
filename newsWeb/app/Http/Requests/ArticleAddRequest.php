<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleAddRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; //return must be true
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'bail|required|unique:articles|max:255|min:5',
            'shortdesc' => 'required|min:10|max:180',
            'thumbnail' => 'required',
            'category_id' => 'required',
            'contents' => 'required|min:100',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Không được phép để trống',
            'title.unique' => 'Không được phép trùng',
            'title.max' => 'Không được dài quá 255 kí tự',
            'title.min' => 'Không được ít hơn 10 kí tự',
            'shortdesc.required' => 'Không được phép để trống',
            'shortdesc.min' => 'Không được ít hơn 100 kí tự',
            'shortdesc.max' => 'Không được quá 180 kí tự',
            'thumbnail.required' => 'Không được phép để trống',
            'category_id.required' => 'Không được phép để trống',
            'contents.required' => 'Không được phép để trống',
            'contents.min' => 'Không được ít hơn 100 kí tự',
        ];
    }
}
