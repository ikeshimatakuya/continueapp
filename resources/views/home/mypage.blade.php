@extends('layouts.after_login_layout')

@section('title', 'マイページ')

@section('content')
    <div>
        <div>
            <h2>画面：マイページ</h2>
        </div><br>
        <br>
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
        認証済みユーザーののactionテーブルの最新のレコードのaction_dateの値が
        ①$todayと違うかそもそも無い場合は登録用のフォームを表示
        ②それ以外は編集用のフォームを表示
        
        ということはgetMypageメソッド内で
        認証済みユーザーののactionテーブルの最新のレコードを取得して渡す必要あり。
        bladeではそのレコードからaction_dateと$todayを比較して上記判定を行う。
        --}}
        
        
        {{-- アクション登録フォーム --}}
        <form action="{{ route('home.mypage') }}" method="post">
            @csrf
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

        </form>
        
    </div>
@endsection