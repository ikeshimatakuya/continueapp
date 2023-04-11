<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\Training;
use App\Models\Action;

class PastActionController extends Controller
{
    
    public function past_history()
    {
        // 認証済みユーザーが保持しているtrainingレコードを全て取得
        // (ゆくゆくは最新レコード順の2番目以降のレコードを取得して表示させるつもりやけど一旦いいや)
        $all_trainings = Auth::user()->trainings()->latest()->get();
        
        return view('home/past_action', ['all_trainings' => $all_trainings]);
    }
    
    
    public function past_pie_chart($month_training_id)
    {
        
        // $month_training(trainingsテーブルのid)を使ってレコードを取得し各カラム値を変数に格納
        $past_trainings = Auth::user()->trainings()
                    ->where('id', '=', $month_training_id)
                    ->get();
        
        foreach($past_trainings as $past_training) {
            $year = $past_training->training_year;
            $month = $past_training->training_month;
            $past_training_start_at = $past_training->training_start_at;
            $past_training_finish_at = $past_training->training_finish_at;
        }
        
        
        // 円グラフに必要なデータの抽出(３つ)
        // ① 月の日数
        $pastDaysInMonth = date('t', strtotime("$year-$month-01")); // Carbon使った方法なんかわからんかったからdate関数使用
        //dd($pastDaysInMonth);
        
        // ② 月のアクションのレコード数を取得
        $user = Auth::user();
        $past_action_count = Action::whereHas('training', function($query) use ($user, $year, $month) {
            $query->where('user_id', $user->id)
                  ->where('training_year', '=', $year)
                  ->where('training_month' , '=', $month);
                  })->count();
        //dd($past_action_count);
        
        // ③ 月のアクションのタイプ別レコード数
        // ③-1 action_type = B のレコード数
        $past_actiontype_B_count = Action::whereHas('training', function($query) use ($user, $year, $month) {
            $query->where('user_id', $user->id)
                  ->where('training_year', '=', $year)
                  ->where('training_month' , '=', $month);
                  })
                  ->where('action_type', '=' , 'B')
                  ->count();
        //dd($past_actiontype_B_count);
        
        // ③-2 action_type = U のレコード数
        $past_actiontype_U_count = Action::whereHas('training', function($query) use ($user, $year, $month) {
            $query->where('user_id', $user->id)
                  ->where('training_year', '=', $year)
                  ->where('training_month' , '=', $month);
                  })
                  ->where('action_type', '=' , 'U')
                  ->count();
       //dd($past_actiontype_U_count);
        
        // ③-3 aaction_type = L のレコード数
        $past_actiontype_L_count = Action::whereHas('training', function($query) use ($user, $year, $month) {
            $query->where('user_id', $user->id)
                  ->where('training_year', '=', $year)
                  ->where('training_month' , '=', $month);
                  })
                  ->where('action_type', '=' , 'L')
                  ->count();
        //dd($past_actiontype_L_count);
        

        
        return view('home/past_pie_chart')->with([
            'past_training_start_at' => $past_training_start_at,
            'past_training_finish_at' => $past_training_finish_at,
            'pastDaysInMonth' => $pastDaysInMonth,
            'past_action_count' => $past_action_count,
            'past_actiontype_B_count' => $past_actiontype_B_count,
            'past_actiontype_U_count' => $past_actiontype_U_count,
            'past_actiontype_L_count' => $past_actiontype_L_count
        ]);
        
    }
}
