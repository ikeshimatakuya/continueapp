<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

use App\Models\Month;

class TrainingController extends Controller
{
    public function create()
    {
        return view('training_register/training_aim_register');
    }
    
    public function createTrainingAim(Request $request)
    {
        // 
        

        $this->validate($request, Month::$rules); // TrainingControllerのobjectが入っている
 
        // インスタンス（レコード）を生成
        $month = new Month;
        
        // $request->all() でformで入力された値を取得
        $month_form = $request->all();
        //dd($training_form);
        
        //dd(Auth::name());
        $month->user_id = Auth::id();
        
        // 開始日と終了日(月末)を取得
        $month->month_training_aim_start_at = Carbon::now();
        // dd($training->month_training_aim_start_at);
        $month->month_training_aim_finish_at = Carbon::now()->endOfMonth();
        // dd($training->month_training_aim_finish_at);
        
        // DBに保存
        $month->fill($month_form)->save();
        $month->save();
        
        return view('training_register/finish_training_aim_register');
    }
    
    /*
    public function mypage(Request $request)
    {
        // 登録したトレーニング目標とかのデータを含めてマイページ画面に遷移
        
        return view('home/mypage', );
    }
    */
}
