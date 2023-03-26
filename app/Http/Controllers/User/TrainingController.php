<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

use App\Models\Training;
use App\Models\User;

class TrainingController extends Controller
{
    public function create()
    {
        return view('training_register/training_aim_register');
    }
    
    public function createTrainingAim(Request $request)
    {
        $this->validate($request, Training::$rules);
        // インスタンス（レコード）を生成
        $training = new Training;
        // $request->all() でformで入力された値を取得
        $training_form = $request->all();
        // user_idを取得
        $training->user_id = Auth::id();
        
        // 現在日時を取得
        $now = Carbon::now();
        // '年'を取得
        $training->training_year = $now->year;
        // '月'を取得
        $training->training_month = $now->month;
        // 開始日時を取得->Y-m-dに変換
        $training->training_start_at = $now->format('Y-m-d');
        // 終了日時取得->Y-m-dに変換
        $finish_date = Carbon::now()->endOfMonth();
        $training->training_finish_at = $finish_date->format('Y-m-d');
        
        // DBに保存
        $training->fill($training_form)->save();
        dd($training);
        $training->save();
        
        return view('training_register/finish_training_aim_register');
    }
    
    public function mypage(Request $request)
    {
        // 登録したトレーニング目標とかのデータを含めてマイページ画面に遷移
        
        // ユーザーごとにデータが格納されている事を確認
        $trainings = Auth::user()->trainings;
        dd($trainings);
        
        
        // 現在の年月をそれぞれ取得
        $now = Carbon::now();
        $year = $now->year; // 取れている事を確認済み
        $month = $now->month; // 取れている事を確認ずみ
        
        return view('home/mypage',['trainings' => $trainings, 'year' => $year, 'month' => $month] );
    }
    
}
