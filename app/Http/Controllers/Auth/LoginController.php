<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function loginShow()
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request)
    {
        $data = $request->only('email', 'password');

        $user = User::query()->where('email', $data['email'])->first();

        if (!$user && !Hash::check($data['password'], $user->password))
        {
            alert()->error('Diqqət','İstifadəçi adı və ya şifrə yanlışdır!');
            return back();
        }

        Auth::login($user, $request->has('remember'));

        alert()->success('Təbriklər!','Uğurla daxil oldunuz!');
        return redirect()->route('admin.index');
    }
}
