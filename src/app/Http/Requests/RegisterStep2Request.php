<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterStep2Request extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            // 現在の体重
            'current_weight' => ['required', 'numeric', 'between:0,999.9', 'decimal:1'],

            // 目標の体重
            'target_weight'  => ['required', 'numeric', 'between:0,999.9', 'decimal:1'],
        ];
    }

    public function messages(): array
    {
        return [
            // 現在の体重
            'current_weight.required' => '体重を入力してください',
            'current_weight.numeric'  => '数字で入力してください',
            'current_weight.between'  => '4桁までの数字で入力してください',
            'current_weight.decimal'  => '小数点は1桁で入力してください',

            // 目標の体重
            'target_weight.required' => '体重を入力してください',
            'target_weight.numeric'  => '数字で入力してください',
            'target_weight.between'  => '4桁までの数字で入力してください',
            'target_weight.decimal'  => '小数点は1桁で入力してください',
        ];
    }
}