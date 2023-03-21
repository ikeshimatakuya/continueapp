<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PastActionController extends Controller
{
    
    public function past_history()
    {
        return view('home/past_action');
    }
    
    public function past_pie_chart()
    {
        return view('home/past_pie_chart');
    }
}
