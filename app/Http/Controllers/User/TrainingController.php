<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Models\Training;

class TrainingController extends Controller
{
    public function create()
    {
        return view('training_register/training_aim_register');
    }
    
    
    public function createTrainingAim(Request $request)
    {
        // validation実行
        $this->validate($request, Training::$rules); // TrainingControllerのobjectが入っている
 
        // インスタンス（レコード）を生成
        $training = new Training;
        // $request->all() でformで入力された値を取得
        $training_form = $request->all();
        //dd($training_form);
        
        
        // 開始日と終了日(月末)を取得
        $training->month_training_aim_start_at = Carbon::now();
        // dd($training->month_training_aim_start_at);
        $training->month_training_aim_finish_at = Carbon::now()->endOfMonth();
        // dd($training->month_training_aim_finish_at);
        
        // DBに保存
        $training->fill($training_form)->save();
        $training->save();
        
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
