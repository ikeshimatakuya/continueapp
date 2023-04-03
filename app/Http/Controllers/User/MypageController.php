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
    /*
    private $year;
    private $month;
    private $trainings;
    */
    
    public function getMypage()
    {
        // 「Training」
        // 現在の年月をそれぞれ取得
        $now = Carbon::now();
        $year = $now->year;   // 現在の年
        $month = $now->month; // 現在の月
        
        // 認証済みのユーザーIDをもとに
        // 認証済みのユーザーのtrainingテーブルの'training_year','month'と$year,$monthが同じレコードを取得。
        $trainings = Auth::user()->trainings()
                ->where('training_year', $year)
                ->where('training_month', $month)
                ->get();
        //dd($trainings);      
        //$a = is_array($trainings);            
        //dd($a);
        
        // $trainingsの#itemsが空の場合、今月のトレーニング登録がまだされていない為、トレーニング登録画面にリダイレクト
        if ($trainings->isEmpty()){
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
            ->first(); // 一度もアクション登録したことがないユーザーの$actionの中身はnull
       // dd($latest_action);

        return view( 'home/mypage', ['trainings' => $trainings], ['latest_action' => $latest_action] );
    }
    
    
    
    public function postMypage(Request $request)
    {
        
        // Validationを行う
        
        
        
        
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
        //dd($trainings);
        
        /*
        認証済みのユーザーのactionテーブルの最新のレコードのaction_dateの値が
        ①$todayと異なる or actionレコードを一個も保持していなければ「登録処理」を実行
        ②それ以外は「編集処理」を実行
        */
        $user = Auth::user();
        $latest_action = $user->trainings->flatMap(function ($training) {
            return $training->actions->sortByDesc('created_at')->take(1);
        })->first();
        //dd($latest_action);
        
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
            
        } else {
            // アクション更新処理
            $actions_form = $request->all();
            $latest_action->fill($actions_form)->save();
            //dd($latest_action);
            
        }
        
        //return view('home/mypage',['trainings' => $trainings], ['latest_action' => $latest_action] );
        return redirect('home/mypage')->with([
            'trainings' => $trainings,
            'latest_action' => $latest_action
        ]);
    }
}
