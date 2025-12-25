<?php

namespace App\Actions\Fortify;

use App\Models\User;
use App\Models\WeightLog;
use App\Models\WeightTarget;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make(
            $input,
            [
                // 現在の体重
                'current_weight' => ['required', 'numeric', 'between:0,999.9', 'decimal:1'],

                // 目標の体重
                'target_weight' => ['required', 'numeric', 'between:0,999.9', 'decimal:1'],
            ],
            [
                 // ===== 現在の体重 =====
                'current_weight.required' => '体重を入力してください',
                'current_weight.numeric'  => '数字で入力してください',
                'current_weight.between'  => '4桁までの数字で入力してください',
                'current_weight.decimal'  => '小数点は1桁で入力してください',

              // ===== 目標の体重 =====
                'target_weight.required' => '体重を入力してください',
                'target_weight.numeric'  => '数字で入力してください',
                'target_weight.between'  => '4桁までの数字で入力してください',
                'target_weight.decimal'  => '小数点は1桁で入力してください',
            ]
        )->validate();


        return DB::transaction(function () use ($input) {

            $user = User::create([
                'name' => $input['name'],
                'email' => $input['email'],
                'password' => Hash::make($input['password']),
            ]);

            WeightTarget::create([
                'user_id' => $user->id,
                'target_weight' => $input['target_weight'],
            ]);

            WeightLog::create([
            'user_id' => $user->id,
            'date' => now()->toDateString(),
            'weight' => $input['current_weight'],
            'calories' => null,
            'exercise_time' => null,
            'exercise_content' => null,
        ]);

        return $user;
        });
    }
}