<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class After_login_Controller extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
     
     // ここからauth機能
    /*
    public function __construct()
    {
        $this->middleware('auth');
    }
    */
    // ここまで
    

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function mypage()
    {
        return view('home/mypage');
    }
    public function post_mypage()
    {
        return view('home/mypage');
    }
    
    public function past_history()
    {
        return view('home/past_action');
    }
    
    public function past_pie_chart()
    {
        return view('home/pie_chart');
    }
    
    public function various_setting()
    {
      return view('home/various_setting');  
    }
    
    public function user_manual()
    {
        // dd('ユーザーマニュアルが呼ばれた');
        return view('home/user_manual');
    }
}
