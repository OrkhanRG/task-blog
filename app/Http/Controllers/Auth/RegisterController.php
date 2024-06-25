<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function registerShow()
    {
        return view('auth.regsiter');
    }

    public function register(Request $request)
    {

    }
}
