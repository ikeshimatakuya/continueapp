@extends('layouts.layout')

@section('title', '過去履歴の円グラフ')

@section('content')
<div class="content-center">
        @foreach($past_trainings as $past_training)
        <p>期間：{{ $past_training->training_start_at }} 〜 {{ $past_training->training_finish_at }}</p>
        <p>習慣化したい事：{{ $past_training->training_aim}}</p>
        @endforeach
    </div>
        
    {{-- 円グラフ１：月当たりの取り組み日数--}}
    <div class="graph-container">
        <div class="graph-wrapper">
            <canvas id="myChart3"></canvas>
            <script>
                const ctx3 = document.getElementById('myChart3');
                const pastDaysInMonth = {{ $pastDaysInMonth }};
                const past_action_count = {{ $past_action_count }};
                const data1 = [past_action_count, pastDaysInMonth - past_action_count];
            
                new Chart(ctx3, {
                    type: 'doughnut',
                    data: {
                        datasets: [{
                            data: data1,
                            borderWidth: 1
                        }]
                    }
                });
            </script>
        </div>
        
        {{-- 円グラフ２：それぞれのアクションの割合 --}}
        <div class="graph-wrapper">
            <canvas id="myChart4"></canvas>
            <script>
                const ctx4 = document.getElementById('myChart4');
                const past_actiontype_B_count = {{ $past_actiontype_B_count }};
                const past_actiontype_U_count = {{ $past_actiontype_U_count }};
                const past_actiontype_L_count = {{ $past_actiontype_L_count }};
                const data2 = [past_actiontype_B_count, past_actiontype_U_count, past_actiontype_L_count];
                    
                new Chart(ctx4, {
                    type: 'doughnut',
                    data: {
                        datasets: [{
                        data: data2,
                        borderWidth: 1
                        }]
                    }
                });
            </script>
        </div>
        <div>
            <input type="button" onclick="history.back()" value="戻る">
        </div>
    </div>
@endsection
