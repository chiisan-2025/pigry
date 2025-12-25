<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Actions\Fortify\CreateNewUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RegisterStep1Request;
use App\Http\Requests\RegisterStep2Request;


class RegisterStepController extends Controller
{
    public function step1()
    {
        return view('auth.register-step1');
    }

    public function postStep1(Request $request)
    {
        $request->validate(
        [
            'name' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required'],
        ],
        [
            'name.required' => 'お名前を入力してください',

            'email.required' => 'メールアドレスを入力してください',
            'email.email'    => 'メールアドレスは「ユーザー名@ドメイン」形式で入力してください',

            'password.required' => 'パスワードを入力してください',
        ]
    );

        $request->session()->put('register.step1', $request->only('name','email','password'));
        return redirect('/register/step2');
    }

    public function step2(Request $request)
    {
        // step1がないと直アクセス防止
        if (!$request->session()->has('register.step1')) {
            return redirect('/register/step1');
        }
        return view('auth.register-step2');
    }

    public function postStep2(RegisterStep2Request $request, CreateNewUser $creator)
    {
        if (!$request->session()->has('register.step1')) {
            return redirect('/register/step1');
        }

        $step1 = $request->session()->get('register.step1');
        $step2 = $request->validated();

        $user = $creator->create([
            'name' => $step1['name'],
            'email' => $step1['email'],
            'password' => $step1['password'],
            'password_confirmation' => $step1['password'],
            'current_weight' => $step2['current_weight'],
            'target_weight'  => $step2['target_weight'],
        ]);

    Auth::login($user);
    $request->session()->forget('register.step1');

    return redirect('/weight_logs');
    }
}