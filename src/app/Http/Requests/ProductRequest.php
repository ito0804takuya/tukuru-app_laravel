<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(Request $request)
    {
        if ($request->method() === 'PUT') {
            return [
                'name' => [
                    'required',
                    'string',
                    Rule::unique('products')->ignore($this->product_id),
                ],
                'image' => 'sometimes|file|image|max:2048'
            ];
        }
        
        return [
            'name' => [
                'required',
                'string',
                Rule::unique('products')->ignore($this->product_id),
            ],
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
