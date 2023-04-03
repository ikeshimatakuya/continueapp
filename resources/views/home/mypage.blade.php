@extends('layouts.after_login_layout')

@section('title', 'マイページ')

@section('content')
    <div>
        <div>
            <h2>画面：マイページ</h2>
        </div><br>
        <br>
        <p>-----今月のトレーニング登録の内容-----</p>
        @foreach ($trainings as $training)
        
            <p>ユーザーID：{{ $training->user_id }}</p>
            <p>開始年：{{ $training->training_year }}</p>
            <p>開始月：{{ $training->training_month }}</p>
            <p>開始日時：{{ $training->training_start_at }}</p>
            <p>終了日時：{{ $training->training_finish_at }}</p>
            <p>習慣化したい事：{{ $training->training_aim }}</p>
            <p>基本目標：{{ $training->training_aim_base }}</p>
            <p>上位目標：{{ $training->training_aim_upper }}</p>
            <p>下位目標：{{ $training->training_aim_lower }}</p><br><br>
        
        @endforeach
        
        {{--
        計算処理関連の記述
        --}}
        
        
        {{--
        認証済みユーザーののactionテーブルの最新のレコードのaction_dateの値が
        ①{{ date('Y-m-d') }}と違うかそもそも無い場合は登録用のフォームを表示
        ②それ以外は編集用のフォームを表示
        
        ということはgetMypageメソッド内で
        認証済みユーザーののactionテーブルの最新のレコードを取得してviewに渡す必要がある。
        bladeではそのレコードのaction_dateカラムの値と$todayを比較して上記判定を行う。
        --}}
        
        <p>-----ここからフォーム------</p>
        
        <form action="{{ route('home.mypage') }}" method="post">
            @csrf
            @if ($latest_action == null || $latest_action->action_date != date('Y-m-d'))
            
            {{-- アクション登録用フォーム--}}
            <P>「今日のアクション登録はまだ完了しておりません」</P>
            <div>
                @foreach($trainings as $training)
                
                    <select name="action_type">
                        <option hidden>選択してください</option>
                        <option value="B">{{ $training->training_aim_base }}</option>
                        <option value="U">{{ $training->training_aim_upper }}</option>
                        <option value="L">{{ $training->training_aim_lower }}</option>
                    </select><br><br><br>
                
                @endforeach
                <input type="submit" value="登録">
            </div>
            
            {{-- アクション更新用フォーム --}}
            @else
            <p>「今日のアクション登録は完了しています。<br>編集する場合はプルダウリストから行ったトレーニングを選択し、更新ボタンを押してください」</p>
            <div>
                @foreach($trainings as $training)
                
                    <select name="action_type">
                        <option hidden>選択してください</option>
                        <option value="B">{{ $training->training_aim_base }}</option>
                        <option value="U">{{ $training->training_aim_upper }}</option>
                        <option value="L">{{ $training->training_aim_lower }}</option>
                    </select><br><br><br>
                
                @endforeach
                <input type="submit" value="更新">
            </div>

            @endif
        </form>
        
    </div>
@endsection