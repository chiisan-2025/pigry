<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreWeightLogRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'date' => ['required', 'date'],

        // 体重：必須 / 数字 / 4桁まで / 小数1桁
            'weight' => ['required', 'numeric', 'between:0,999.9', 'decimal:1'],

        // 摂取カロリー：必須 / 数字（整数）
            'calories' => ['required', 'integer'],

        // 運動時間：必須（形式も縛るなら後述）
            'exercise_time' => ['required', 'date_format:H:i'],

        // 運動内容：必須 / 120文字以内
            'exercise_content' => ['required', 'string', 'max:120'],
        ];
    }

    public function messages(): array
    {
        return [
        // 日付
            'date.required' => '日付を入力してください',

        // 体重
            'weight.required' => '体重を入力してください',
            'weight.numeric' => '数字で入力してください',
            'weight.between' => '4桁までの数字で入力してください',
            'weight.decimal' => '小数点は1桁で入力してください',

        // 摂取カロリー
            'calories.required' => '摂取カロリーを入力してください',
            'calories.integer' => '数字で入力してください',

        // 運動時間
            'exercise_time.required' => '運動時間を入力してください',
            'exercise_time.date_format'  => '運動時間は「HH:MM」形式で入力してください',

        // 運動内容
            'exercise_content.required' => '運動内容を入力してください',
            'exercise_content.max' => '120文字以内で入力してください',
        ];
    }

    public function attributes(): array
    {
        return [
            'date' => '日付',
            'weight' => '体重',
            'calories' => '摂取カロリー',
            'exercise_time' => '運動時間',
            'exercise_content' => '運動内容',
        ];
    }
}