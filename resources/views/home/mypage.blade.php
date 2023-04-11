@extends('layouts.layout')

@section('title', 'マイページ')

@section('content')
    <div>
        <div>
            <h2>画面：マイページ</h2>
        </div><br>
        <br>
        <p>-----今月のトレーニング登録の内容-----</p>
        @foreach ($trainings as $training)
            
            <p>トレーニングID：{{ $training->id }}</p>
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
        「円グラフ用の計算処理の記述」
        --}}
        <p>-----円グラフに必要なデータ------</p>
        <p>今月の日数：{{ $daysInMonth }}</p>
        <p>今月のアクションした合計：{{ $action_count }}</p>
        <p>今月の'B'のアクションした合計：{{ $actiontype_B_count }}</p>
        <p>今月の'U'のアクションした合計：{{ $actiontype_U_count }}</p>
        <p>今月の'L'のアクションした合計：{{ $actiontype_L_count }}</p><br><br>
        
        <canvas id="myChart1"></canvas>
        
        {{--
        使用するデータ：$daysInMonth,$action_count
        --}}
        <script>
            const ctx = document.getElementById('myChart1');
            new Chart(ctx, {
                type: 'doughnut',
                data: {
                    {{--
                    ラベルは無し
                    --}}
                    datasets: [{
                        label: '# of Votes',
                        data: [30,12],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        </script>
        

        
        
        <br>
        <p>-----毎日のアクションの登録 / 更新フォーム------</p>
        
        {{-- action_dateの値で登録処理用の表示を更新用の表示を切り分けする --}}
        <form action="{{ route('home.mypage') }}" method="post">
            @csrf
            @if ($latest_action == null || $latest_action->action_date != date('Y-m-d'))
            
            {{-- アクション登録用フォーム--}}
            <P>「今日のアクション登録はまだ完了していません」</P>
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
            <p>「今日のアクション登録は完了しています。<br>編集する場合はプルダウンリストから行ったトレーニングを選択し、更新ボタンを押してください」</p>
            
            <div>
                @foreach($trainings as $training)
                
                    <select name="action_type">
                        <option hidden>選択してください</option>
                        <option value="B">{{ $training->training_aim_base }}</option>
                        <option value="U">{{ $training->training_aim_upper }}</option>
                        <option value="L">{{ $training->training_aim_lower }}</option>
                    </select><br><br>
                
                @endforeach
                
                {{-- バリデーション表示（日本語変換がまだ） --}}
                @if (count($errors) > 0)
                <ul>
                    @foreach($errors->all() as $e)
                    <li>{{ $e }}</li>
                    @endforeach
                </ul>
                @endif
                <input type="submit" value="更新">
            </div>

            @endif
        </form>
        
        <br><br>
        <p>-----今月のアクション履歴を全て表示-----</p>
        <table>
            <thead>
                <tr>
                    <th width="80%">日付</th>
                    <th width="20%">種別</th>
                </tr>
            </thead>
            <tbody>
                @foreach($action_histories as $action_history)
                    <tr>
                        <td>{{ $action_history->action_date }}</td>
                        <td>{{ $action_history->action_type }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <br><br><br><br>
    </div>
@endsection