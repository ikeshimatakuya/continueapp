<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Before_login_Controller extends Controller
{
    //
    public function finish_user_register()
    {
        return view('auth/finish_user_register');
    }
    public function action_register()
    {
        return view('auth/action_register');
    }
    public function finish_action_register()
    {
        return view('auth/finish_action_register');
    }
}
