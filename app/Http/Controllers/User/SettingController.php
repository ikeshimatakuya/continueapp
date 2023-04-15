<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class SettingController extends Controller
{
    public function index()
    {
        $user_id = Auth::id();
        return view('home/user_setting')->with([
            'user_id' => $user_id
        ]);
    }

    public function update(Request $request)
    {


        return redirect()->route('home.update');
    }
}