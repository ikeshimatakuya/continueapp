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
        // 「Training」
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
        
        // $trainingsの#itemsが空の場合はトレーニング登録画面にリダイレクト
        if ($trainings->isEmpty()){
            return redirect('training_register/training_aim_register');     
        }
        
        
        /*
        「Action」
        認証済みユーザー毎にactionsテーブルから最近作成されたactionレコードを$latest_actionに代入
        */
        
        /*
        $user = Auth::user();
        $user->load(['trainings.actions' => function ($query) {
            $query->orderBy('created_at', 'desc')->take(1);
        }]);
        $latest_action = $user->trainings->pluck('actions')->collapse();
 
        //dd($latest_action);
        
    
        
        
        // アクション登録処理
        $actions = new Action;
        $actions_form = $request->all();
        $actions->action_date = $today;
        
        // $trainingsからidだけ抽出して、traning_idに代入
        foreach ($trainings as $training) {
            $actions->training_id = $training->id;
        }

        $actions->fill($actions_form)->save();
        */
        
        
  
        
        return view('home/mypage',['trainings' => $trainings] );
    }
    
}
