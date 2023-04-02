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
        
        return view('training_register/finish_training_aim_register');
    }
    
    
    public function mypage(Request $request)
    {
        // 現在の年月をそれぞれ取得
        $now = Carbon::now();
        $year = $now->year;   // 現在の年
        $month = $now->month; // 現在の月
        $today = $now->format('Y-m-d'); // Y-m-d
        
        // ログイン中のユーザーIDをもとに
        // ログインユーザーのtrainingテーブルの'training_year','month'と$year,$monthが同じレコードを取得。
        $trainings = Training::where('user_id', Auth::id())
                    ->where('training_year', '=', $year)
                    ->where('training_month' , '=', $month)
                    ->get();
                    
        //dd($trainings);
        // 4月のTrainingデータを保持していないユーザーでログインすると、Mypageでデータが何も表示されない為、ちゃんとデータは取れてそう
        
        // $trainingsがnullの場合はトレーニング登録画面にリダイレクト->なんでかできない
        if ($trainings == null){
            return redirect('training_register/training_aim_register');     
        }
        
        
        /*
        予めEloquentでログインユーザー毎のactionテーブルから$todayと同じ値のレコードを$today_actionに代入
        $today_actionがnullの場合、action登録処理
        そうでない場合、action編集処理
        
        検索条件：
        ログインユーザーid
        action_dateが今日のデータ(Y-m-d)
        */
        
        /*
        // 一回アクション登録する
        $actions = new Action;
        $actions_form = $request->all();
        $actions->action_date = $today;
        $actions->training_id = $trainings->id;
                    
        
        $actions->fill($actions_form)->save();
        */
        
        
        /*
        $today_action = 
        
        // 毎日のアクション登録処理
        $actions = new Action;
        $actions_form = $request->all();
        $actions->training_id = Training::where('user_id', Auth::user())
                                ->where('id', max(Trainings::id))
                                ->get(['id']);
        $actions->fill($actions_form)->save();
        */
        
        
        return view('home/mypage',['trainings' => $trainings] );
    }
    
}
