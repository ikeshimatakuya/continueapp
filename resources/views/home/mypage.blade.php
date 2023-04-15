@extends('layouts.layout')

@section('title', 'マイページ')

@section('content')
    <br>
    <div>
        <div>
            @foreach($trainings as $training)
            <h3>{{ $training->training_start_at }} 〜 {{ $training->training_finish_at }}</h3>
            @endforeach
        </div><br>
        
        {{-- 円グラフ１：月当たりの取り組み日数--}}
        <canvas id="myChart1"></canvas>
        <script>
            const ctx = document.getElementById('myChart1');
            const daysInMonth = {{ $daysInMonth }};
            const action_count = {{ $action_count }};
            const data1 = [action_count, daysInMonth];
            
            new Chart(ctx, {
                type: 'doughnut',
                data: {
                    datasets: [{
                        data: data1,
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                },
            });
        </script>
        
        
        {{-- 円グラフ２：それぞれのアクションの割合 --}}
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
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                },
            });
        </script>
        

        {{-- action_dateの値で登録処理用の表示を更新用の表示を切り分けする --}}
        <form action="{{ route('home.mypage') }}" method="post">
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
            <p>「今日のアクション登録はまだ完了していません」</p>
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
            <p>今日のアクション登録は完了しています。<br>編集する場合はプルダウンリストから行ったトレーニングを選択し、更新ボタンを押してください</p>
            
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
        
        <br><br>
        <p>-----今月のアクション履歴を全て表示-----</p>
        <table>
            <thead>
                <tr>
                    <th width="40%">日付</th>
                    <th width="20%">種別</th>
                    <td width="20%">取り組んだこと</td>
                </tr>
            </thead>
            <tbody>
                @foreach($action_histories as $action_history)
                    <tr>
                        <td>{{ $action_history->action_date }}</td>
                        <td>{{ $action_history->action_type }}</td>
                        <td>
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

        <br><br><br><br>
    </div>
@endsection