<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateWeightTargetRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'target_weight' => ['required', 'numeric', 'between:0,999.9', 'decimal:1'],
        ];
    }

    public function messages(): array
    {
        return [
            'target_weight.required' => '目標体重を入力してください',
            'target_weight.numeric'  => '数字で入力してください',
            'target_weight.between'  => '4桁までの数字で入力してください',
            'target_weight.decimal'  => '小数点は1桁で入力してください',
        ];
    }

    public function attributes(): array
    {
        return [
            'target_weight' => '目標体重',
        ];
    }
}