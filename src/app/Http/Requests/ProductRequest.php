<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|unique:products,name',
            'image' => 'required|file|image|max:2048'
        ];
    }

    public function messages()
    {
        return [
            'name.requied' => '商品名は必ず入力してください',
            'name.string' => '商品名は文字で入力してください',
            'name.unique' => '既に同じ商品名が存在します'
        ];
    }
}
