@extends('layouts.layout')

@section('title', 'マイページ')

@section('content')
    <div class="content-center">
        @foreach($trainings as $training)
        <p>期間：{{ $training->training_start_at }} 〜 {{ $training->training_finish_at }}</p>
        <p>習慣化したい事：{{ $training->training_aim}}</p>
        @endforeach
    </div>
        
    {{-- 円グラフ１：月当たりの取り組み日数--}}
    <div class="graph-container">
        <div class="graph-wrapper">
            <canvas id="myChart1"></canvas>
            <script>
                const ctx = document.getElementById('myChart1');
                const daysInMonth = {{ $daysInMonth }};
                const action_count = {{ $action_count }};
                const data1 = [action_count, daysInMonth - action_count];
            
                new Chart(ctx, {
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
            <canvas id="myChart2"></canvas>
            <script>
                const ctx2 = document.getElementById('myChart2');
                const actiontype_B_count = {{ $actiontype_B_count }};
                const actiontype_U_count = {{ $actiontype_U_count }};
                const actiontype_L_count = {{ $actiontype_L_count }};
                const data2 = [actiontype_B_count, actiontype_U_count, actiontype_L_count];
                    
                new Chart(ctx2, {
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
    </div>
        
    {{-- action_dateの値で登録処理用の表示を更新用の表示を切り分けする --}}
    <div class="content-center">
        <form class="action-form" action="{{ route('home.mypage') }}" method="post">
        @csrf
            {{-- バリデーション表示 --}}
            @if (count($errors) > 0)
                <ul>
                    @foreach($errors->all() as $e)
                        <li>{{ $e }}</li>
                    @endforeach
                </ul>
            @endif
            
            {{-- 今日のアクション登録が完了しているか判断 --}}
            @if ($latest_action == null || $latest_action->action_date != date('Y-m-d'))
            
            {{-- アクション登録用フォーム--}}
            <div>
                <p>「今日のアクション登録はまだ完了していません」</p>  
            </div>

            <div>
                @foreach($trainings as $training)
                
                <select name="action_type">
                    <option hidden>選択してください</option>
                    <option value="B">{{ $training->training_aim_base }}</option>
                    <option value="U">{{ $training->training_aim_upper }}</option>
                    <option value="L">{{ $training->training_aim_lower }}</option>
                </select><br><br>
                
                @endforeach
                <input type="submit" value="登録">
            </div>
            
            {{-- アクション更新用フォーム --}}
            @else
            <div>
                <p>今日のアクション登録は完了しています。</p>
                <p>編集する場合はプルダウンリストから行ったトレーニングを選択し、更新ボタンを押してください。</p>
            </div>

            <div>
                @foreach($trainings as $training)
                
                <select name="action_type">
                    <option hidden>選択してください</option>
                    <option value="B">{{ $training->training_aim_base }}</option>
                    <option value="U">{{ $training->training_aim_upper }}</option>
                    <option value="L">{{ $training->training_aim_lower }}</option>
                </select><br><br>
                
                @endforeach
                
                <input type="submit" value="更新">
            </div>

            @endif
        </form>
    </div>
        
    {{-- これより下は仮実装 --}}
    <div class="content-center">
        <p>-----今月の履歴-----</p>
        <table id="mypage-table">
            <thead>
                <tr>
                    <th id="mypage-th-left" width="50%">日付</th>
                    <th id="mypage-th-right" width="50%">取り組んだこと</th>
                </tr>
            </thead>
            <tbody>
                @foreach($action_histories as $action_history)
                <tr>
                    <td id="mypage-td-left">{{ $action_history->action_date }}</td>
                    <td id="mypage-td-right">
                        @switch($action_history->action_type)
                        @case('B')
                            {{ $training->training_aim_base }}
                        @break
                            
                        @case('U')
                            {{ $training->training_aim_upper }}
                        @break
                            
                        @default
                            {{ $training->training_aim_lower }}
                        @endswitch
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection