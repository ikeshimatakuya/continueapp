<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MypageController extends Controller
{
    
    public function mypage()
    {
        return view('home/mypage');
    }
}
