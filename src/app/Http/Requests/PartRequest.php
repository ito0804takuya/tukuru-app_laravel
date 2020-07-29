<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PartRequest extends FormRequest
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
    public function rules()
    {
        return [
            'name' => [
                'required',
                'string',
                Rule::unique('parts')->ignore($this->part_id),
            ],
            'supplier_id' => 'required|exists:suppliers,id'
        ];
    }

    public function messages()
    {
        return [
            'name.requied' => '部品名は必ず入力してください',
            'name.string' => '部品名は文字で入力してください',
            'name.unique' => '既に同じ部品名が存在します',
            'supplier_id.requied' => '仕入先は必ず指定してください',
            'supplier_id.exists' => '指定された仕入先が存在しません',
        ];
    }
}
