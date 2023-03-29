@extends('layouts.after_login_layout')

@section('title', 'マイページ')

@section('content')
    <div>
        <div>
            <h2>画面：マイページ</h2>
        </div><br>
        
        <form action="{{ route('home.mypage') }}" method="post">
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
                        
                <select name="">
                    <option hidden>選択してください</option>
                    <option>{{ $training->training_aim_base }}</option>
                    <option>{{ $training->training_aim_upper }}</option>
                    <option>{{ $training->training_aim_lower }}</option>
                </select><br><br><br>
                
                {{-- actionがその日登録されていなかったら「登録」、すでに登録されていたら「更新」を表示--}}
                {{--
                <input type="submit" value="登録">
                --}}

            @endforeach
            </div>

        </form>
        
    </div>
@endsection