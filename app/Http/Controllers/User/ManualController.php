<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ManualController extends Controller
{
    //
    public function user_manual()
    {
        // dd('ユーザーマニュアルが呼ばれた');
        return view('home/user_manual');
    }
}