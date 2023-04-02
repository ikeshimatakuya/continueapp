@extends('layouts.after_login_layout')

@section('title', 'マイページ')

@section('content')
    <div>
        <div>
            <h2>画面：マイページ</h2>
        </div><br>
        
        <form action="{{ route('home.mypage') }}" method="post">
            @csrf
            <div>
            @foreach($trainings as $training)

                <p>ユーザーID：{{ $training->user_id }}</p>
                <p>開始年：{{ $training->training_year }}</p>
                <p>開始月：{{ $training->training_month }}</p>
                <p>開始日時：{{ $training->training_start_at }}</p>
                <p>終了日時：{{ $training->training_finish_at }}</p>
                <p>習慣化したい事：{{ $training->training_aim }}</p>
                <p>基本目標：{{ $training->training_aim_base }}</p>
                <p>上位目標：{{ $training->training_aim_upper }}</p>
                <p>下位目標：{{ $training->training_aim_lower }}</p><br><br>
                
                
                {{--
                $today_actionがnullの場合、登録処理
                それ以外は更新処理
                --}}
                
                <select name="action_type">
                    <option hidden>選択してください</option>
                    <option value="B">{{ $training->training_aim_base }}</option>
                    <option value="U">{{ $training->training_aim_upper }}</option>
                    <option value="L">{{ $training->training_aim_lower }}</option>
                </select><br><br><br>
                
                
                
                <input type="submit" value="登録">
                

            @endforeach
            </div>

        </form>
        
    </div>
@endsection