@extends('layouts.after_login_layout')

@section('title', 'マイページ')

@section('content')
    <div>
        <div>
            <h2>画面：マイページ</h2>
        </div><br>
        
        <div>

            @foreach($trainings as $training)
                {{--
                @if ($training['training_year'] == $year )
                
                    @if ( $training['training_month']  == $month ) --}}
                    
                        <p>ユーザーID：{{ $training->user_id }}</p>
                        <p>開始年：{{ $training->training_year }}</p>
                        <p>開始月：{{ $training->training_month }}</p>
                        <p>開始日時：{{ $training->training_start_at }}</p>
                        <p>終了日時：{{ $training->training_finish_at }}</p>
                        <p>習慣化したい事：{{ $training->training_aim }}</p>
                        <p>基本目標：{{ $training->training_aim_base }}</p>
                        <p>上位目標：{{ $training->training_aim_upper }}</p>
                        <p>下位目標：{{ $training->training_aim_lower }}</p>
                    {{--
                    @endif
                
                @endif
                --}}
                {{--
                <p>ユーザーID：{{ $month->user_id }}</p>
                <p>開始日時：{{ $month->month_training_aim_start_at }}</p>
                <p>終了日時：{{ $month->month_training_aim_finish_at }}</p>
                <p>習慣化したい事：{{ $month->month_training_aim }}</p>
                <p>基本目標：{{ $month->month_training_aim_base }}</p>
                <p>上位目標：{{ $month->month_training_aim_upper }}</p>
                <p>下位目標：{{ $month->month_training_aim_lower }}</p>
                --}}
                
            @endforeach
            <br>
            <button type="submit">更新</button>
        </div>
    </div>
@endsection