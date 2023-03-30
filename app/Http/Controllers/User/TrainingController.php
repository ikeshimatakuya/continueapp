<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\Training;
use App\Models\Action;

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
        
        // $tariningにフォームで入力したデータを代入
        $training->fill($training_form)->save();
        // dd($training); // $trainingが正確に取れている事を確認
        // DBに保存
        // $training->save();
        
        return view('training_register/finish_training_aim_register');
    }
    
    public function mypage(Request $request)
    {
        // ログインユーザーのレコードが最新のデータを取得
        //$trainings = Auth::user()->trainings; // この文だとユーザーが保持しているすべてのtrainingデータを取得してしまう
        $trainings = Auth::user()->trainings('user_id')->orderBy('created_at', 'desc')->first(); 
        //dd($trainings);
        

        // 現在の年月をそれぞれ取得
        $now = Carbon::now();
        $year = $now->year;   // 現在の年
        $month = $now->month; // 現在の月
        
        // 以下、if文でリダイレクトさせるか判定
        
        
        
        $actions = new Action;
        
        return view('home/mypage',['trainings' => $trainings] );
    }
    
}
