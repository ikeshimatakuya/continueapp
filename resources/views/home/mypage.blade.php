@extends('layouts.after_login_layout')

@section('title', 'マイページ')

@section('content')
    <div>
        <div>
            <h2>画面：マイページ</h2>
        </div><br>
        
        {{--
        <div>
            <table>
                <thead>
                    <th width="2%">ID</th>
                    <th width="9%">開始日</th>
                    <th width="9%">終了日</th>
                    <th width="20%">1ヶ月の目標</th>
                    <th width="20%">基本トレーニング</th>
                    <th width="20%">上位トレーニング</th>
                    <th width="20%">下位トレーニング</th>
                </thead>
                <tbody>
                    <th>{{ $training->id }}</th>
                    <td>{{ $training->month_training_aim_start_at }}</td>
                    <td>{{ $training->month_training_aim_finish_at }}</td>
                    <td>{{ $training->month_training_aim }}</td>
                    <td>{{ $training->month_training_aim_base }}</td>
                    <td>{{ $training->month_training_aim_upper }}</td>
                    <td>{{ $training->month_training_aim_lower }}</td><br>
                </tbody>
            </table>
        </div>
        --}}
        
        <div>
            <button type="submit">更新</button>
        </div>
    </div>
@endsection