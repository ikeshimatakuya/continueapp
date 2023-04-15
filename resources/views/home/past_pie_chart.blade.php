@extends('layouts.layout')

@section('title', '過去履歴２')

@section('content')
    <div>
        <div>
            <h2>{{ $past_training_start_at }} 〜 {{ $past_training_finish_at }}</h2>
        </div>
        
        <div>
            <p>-----円グラフに必要なデータ------</p>
            <p>日数：{{ $pastDaysInMonth }}</p>
            <p>アクションした合計：{{ $past_action_count }}</p>
            <p>'B'のアクションした合計：{{ $past_actiontype_B_count }}</p>
            <p>'U'のアクションした合計：{{ $past_actiontype_U_count }}</p>
            <p>'L'のアクションした合計：{{ $past_actiontype_L_count }}</p><br>
        </div>

        <div>
            <input type="button" onclick="history.back()" value="戻る">
        </div>

    </div>
@endsection
