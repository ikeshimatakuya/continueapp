<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\Training;
use App\Models\Action;

class MypageController extends Controller
{
    public function getMypage()
    {
        // 「Training」
        // 現在の年月をそれぞれ取得
        $now = Carbon::now();
        $year = $now->year;   // 現在の年
        $month = $now->month; // 現在の月
        $today = $now->format('Y-m-d'); // Y-m-d
        
        // 認証済みのユーザーIDをもとに
        // 認証済みのユーザーのtrainingテーブルの'training_year','month'と$year,$monthが同じレコードを取得。
        $trainings = Training::where('user_id', Auth::id())
                    ->where('training_year', '=', $year)
                    ->where('training_month' , '=', $month)
                    ->get();
                    
        //dd($trainings);
        
        // $trainingsの#itemsが空の場合はトレーニング登録画面にリダイレクト
        if ($trainings->isEmpty()){
            return redirect('training_register/training_aim_register');     
        }
        
        
        // 以下、viewに渡すためのデータ(action最新レコード)を取得（エラーでるよー）
        $user = Auth::user();
        $user->load(['trainings.actions' => function ($query) {
            $query->orderBy('created_at', 'desc')->take(1);
        }]);
        $latest_action = $user->trainings->pluck('actions')->collapse();
        dd($latest_action->action_date);
        
        
        return view('home/mypage', ['trainings' => $trainings] );
    }
    
    
    
    public function postMypage(Request $request)
    {
        // 「Training」
        // 現在の年月をそれぞれ取得(getで定義したやつ使えへんのかな)
        $now = Carbon::now();
        $year = $now->year;   // 現在の年
        $month = $now->month; // 現在の月
        $today = $now->format('Y-m-d'); // Y-m-d
        
        // 認証済みのユーザーIDをもとに
        // 認証済みのユーザーのtrainingテーブルの'training_year','month'と$year,$monthが同じレコードを取得。
        $trainings = Training::where('user_id', Auth::id())
                    ->where('training_year', '=', $year)
                    ->where('training_month' , '=', $month)
                    ->get();
        
        
        /*
        認証済みのユーザーのactionテーブルの最新のレコードのaction_dateの値が
        ①$todayと異なる or actionレコードを一個も保持していなければ「登録処理」を実行
        ②それ以外は「編集処理」を実行
        */
        $user = Auth::user();
        $latest_action = $user->trainings->flatMap(function ($training) {
            return $training->actions->sortByDesc('created_at')->take(1);
        })->first();
        dd($latest_action);
        
        
        // アクション登録処理
        $actions = new Action;
        $actions_form = $request->all();
        $actions->action_date = $today;
        
        // $trainingsからidだけ抽出して、traning_idに代入
        foreach ($trainings as $training) {
            $actions->training_id = $training->id;
        }

        $actions->fill($actions_form)->save();
        
        return redirect('home/mypage',['trainings' => $trainings] );
        
    }
}
