<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FinishUserRegisterController extends Controller
{
    //
    public function finish_user_register()
    {
        return view('auth/finish_user_register');
    }
}
