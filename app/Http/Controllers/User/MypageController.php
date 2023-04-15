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
        $this->middleware('auth');
        
        // 「Training」
        $now = Carbon::now();
        $year = $now->year;   // 現在の年
        $month = $now->month; // 現在の月
        
        // 認証済みのユーザーIDをもとに
        // trainingテーブルの'training_year','training_month'と$year,$monthがそれぞれ同じレコードを取得。
        $trainings = Auth::user()->trainings()
                ->where('training_year', '=',  $year)
                ->where('training_month', '=', $month)
                ->get();
        
        // $trainingsの#itemsが空の場合、今月のトレーニング登録がまだされていないのでトレーニング登録画面にリダイレクト
        if ($trainings->isEmpty()){ // $trainings->null やとエラーになるなんでや
            return redirect('training_register/training_aim_register');     
        }
        
        
        // 以下、認証済みユーザーが保持している最新のactionレコードを取得
        /* chatGPT先輩より
        Auth::user()で認証済みのユーザーを取得し、そのユーザーが関連付けられているTrainingモデルが持つ最新のActionレコードを取得しています。
        whereHasメソッドを使用して、ログインしているユーザーが所有するトレーニングが存在するActionレコードを絞り込んでいます。
        そして、withメソッドを使用して、Actionモデルのtrainingリレーション先のデータを取得しています。
        最後に、latestメソッドを使用して、最新のActionレコードを取得しています。
        */
        $user = Auth::user();
        $latest_action = Action::whereHas('training', function($query) use ($user) {
                $query->where('user_id', $user->id);
            })
            ->with('training')
            ->latest() // カラム名が指定されない場合、created_atカラムがデフォルトで使用される
            ->first(); // 一度もアクション登録したことがないユーザーの$actionの中身はnullのため、$latest_actionの中身もnullになる
        // dd($latest_action);
       
       
        // 円グラフに必要なデータの抽出(３つ)
        // ①今月の日数
        $daysInMonth = $now->daysInMonth; 
        
        // ②今月のアクションのレコード数を取得
        $action_count = Action::whereHas('training', function($query) use ($user, $year, $month) { // 今月のアクションのレコード数を取得 -> Undefined variable $year(解消済)
            $query->where('user_id', $user->id)
                  ->where('training_year', '=', $year)
                  ->where('training_month' , '=', $month);
                  })->count();
        //dd($action_count); // 無名関数use()の中に使いたい変数を定義する必要がある（事前に初期化する必要あり）
        
        // ③今月のアクションのタイプ別レコード数
        // ③-1 action_type = B のレコード数
        $actiontype_B_count = Action::whereHas('training', function($query) use ($user, $year, $month) {
            $query->where('user_id', $user->id)
                  ->where('training_year', '=', $year)
                  ->where('training_month' , '=', $month);
                  })
                  ->where('action_type', '=' , 'B')
                  ->count();
        //dd($actiontype_B_count);
        
        // ③-2 action_type = U のレコード数
        $actiontype_U_count = Action::whereHas('training', function($query) use ($user, $year, $month) {
            $query->where('user_id', $user->id)
                  ->where('training_year', '=', $year)
                  ->where('training_month' , '=', $month);
                  })
                  ->where('action_type', '=' , 'U')
                  ->count();
       //dd($actiontype_U_count);
        
        // ③-3 aaction_type = L のレコード数
        $actiontype_L_count = Action::whereHas('training', function($query) use ($user, $year, $month) {
            $query->where('user_id', $user->id)
                  ->where('training_year', '=', $year)
                  ->where('training_month' , '=', $month);
                  })
                  ->where('action_type', '=' , 'L')
                  ->count();
        //dd($actiontype_L_count);
        
        
        // 今月のアクションの履歴を表示させるための配列を用意
        $action_histories = Action::whereHas('training', function($query) use ($user, $year, $month) {
            $query->where('user_id', $user->id)
                  ->where('training_year', '=', $year)
                  ->where('training_month' , '=', $month);
                  })
                  ->get();
        //dd($action_histories);
        

        return view('home/mypage')->with([
            'trainings' => $trainings,
            'latest_action' => $latest_action,
            'daysInMonth' => $daysInMonth,
            'action_count' => $action_count,
            'actiontype_B_count' => $actiontype_B_count,
            'actiontype_U_count' => $actiontype_U_count,
            'actiontype_L_count' => $actiontype_L_count,
            'action_histories' => $action_histories
        ]);
    }
    
    public function postMypage(Request $request)
    {
        
        // Validationを行う
        $this->validate($request, Action::$rules);
        
        // 「Training」
        $now = Carbon::now();
        $year = $now->year;   // 現在の年
        $month = $now->month; // 現在の月
        $today = $now->format('Y-m-d'); // Y-m-d


        // 認証済みのユーザーIDをもとに
        // trainingテーブルの'training_year','month'と$year,$monthが同じレコードを取得。
        $trainings = Training::where('user_id', Auth::id())
                    ->where('training_year', '=', $year)
                    ->where('training_month' , '=', $month)
                    ->get();
        //dd($trainings);
        
        /*
        認証済みユーザーのactionテーブルの最新のレコードのaction_dateの値が
        ①$todayと異なる or actionレコードを一個も保持していなければ「登録処理」を実行
        ②それ以外は「編集処理」を実行
        */
        // 認証済みユーザーの最新のactionsテーブルのレコードを$latest_actionに格納
        $user = Auth::user();
        $latest_action = $user->trainings->flatMap(function ($training) {
            return $training->actions->sortByDesc('created_at')->take(1);
        })->first();
        //dd($latest_action);
        
        // $latest_actionがnullまたは今日の日付とaction_dateの値が異なる場合はアクション登録処理を実行
        if($latest_action == null || $latest_action->action_date != $today) {
            // アクション登録処理
            $actions = new Action;
            $actions_form = $request->all();
            $actions->action_date = $today;
        
            // $trainingsからidだけ抽出して、traning_idに代入
            foreach ($trainings as $training) {
                $actions->training_id = $training->id;
            }

            $actions->fill($actions_form)->save();
        
        // 今日の日付とaction_dateの値が同じ場合はアクション編集処理を実行 
        } else {
            // アクション更新処理
            $actions_form = $request->all();
            $latest_action->fill($actions_form)->save();
            //dd($latest_action);
        }
        
        // 円グラフに必要なデータの抽出(３つ)
        // ①今月の日数
        $daysInMonth = $now->daysInMonth; 
        
        // ②今月のアクションのレコード数を取得
        $action_count = Action::whereHas('training', function($query) use ($user, $year, $month) { // 今月のアクションのレコード数を取得 -> Undefined variable $year(解消済)
            $query->where('user_id', $user->id)
                  ->where('training_year', '=', $year)
                  ->where('training_month' , '=', $month);
                  })->count();
        //dd($action_count); // 無名関数use()の中に使いたい変数を定義する必要がある（事前に初期化する必要あり）
        
        // ③今月のアクションのタイプ別レコード数
        // ③-1 action_type = B のレコード数
        $actiontype_B_count = Action::whereHas('training', function($query) use ($user, $year, $month) {
            $query->where('user_id', $user->id)
                  ->where('training_year', '=', $year)
                  ->where('training_month' , '=', $month);
                  })
                  ->where('action_type', '=' , 'B')
                  ->count();
        //dd($actiontype_B_count);
        
        // ③-2 action_type = U のレコード数
        $actiontype_U_count = Action::whereHas('training', function($query) use ($user, $year, $month) {
            $query->where('user_id', $user->id)
                  ->where('training_year', '=', $year)
                  ->where('training_month' , '=', $month);
                  })
                  ->where('action_type', '=' , 'U')
                  ->count();
       //dd($actiontype_U_count);
        
        // ③-3 aaction_type = L のレコード数
        $actiontype_L_count = Action::whereHas('training', function($query) use ($user, $year, $month) {
            $query->where('user_id', $user->id)
                  ->where('training_year', '=', $year)
                  ->where('training_month' , '=', $month);
                  })
                  ->where('action_type', '=' , 'L')
                  ->count();
        //dd($actiontype_L_count);
        
        // 今月のアクション履歴を日毎に表示(時間があれば実装)
                // 今月のアクションの履歴を表示させるための配列を用意
        $action_histories = Action::whereHas('training', function($query) use ($user, $year, $month) {
            $query->where('user_id', $user->id)
                  ->where('training_year', '=', $year)
                  ->where('training_month' , '=', $month);
                  })
                  ->get();
        //dd($action_histories);
        
        return redirect('home/mypage')->with([
            'trainings' => $trainings,
            'latest_action' => $latest_action,
            'daysInMonth' => $daysInMonth,
            'action_count' => $action_count,
            'actiontype_B_count' => $actiontype_B_count,
            'actiontype_U_count' => $actiontype_U_count,
            'actiontype_L_count' => $actiontype_L_count,
            'action_histories' => $action_histories
        ]);
    }
}