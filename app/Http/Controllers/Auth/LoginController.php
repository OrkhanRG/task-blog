<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function loginShow()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {

    }
}
