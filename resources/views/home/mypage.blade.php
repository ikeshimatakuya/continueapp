@extends('layouts.layout')

@section('title', 'マイページ')

@section('content')


    {{-- 新規会員の場合トレーニング登録画面へ遷移させるver の画面を表示 --}}
    @if ($training_parameter == 0)
    <div class="start-guide">
        <div>
            <h2>会員登録完了</h2>
        </div>
        
        <div class="guide-text">
            <p>本アプリの使い方を簡単に説明します。</p>
            <p>まず最初に習慣化したい事を決めていただきます。</p>
            <p>（例：ランニング）</p><br>
            <p>次に上で決めた習慣化したい事を継続させる為に3種類のトレーニングを決めていただくのですが簡単に説明します。</p>
            <p>全部で３つのトレーニングを登録していただきます。</p>
            <p>まず基準となるトレーニングを決めていただきます。</p>
            <p>（例：ランニング3km）</p><br>
            <p>基本的には基準トレーニングを毎日行って習慣化を目指す流れですが、</p>
            <p>日によっては基準トレーニングをよりも取り組む日があるかと思います。</p>
            <p>よって基準トレーニングの上位互換となるトレーニングを決めていただきます。</p>
            <p>（例：ランニング5km）</p><br>
            <p>次に下位トレーニングを決めていただくのですがこれが重要です。</p>
            <p>例えばランニングなどは、天気によっては行えないことがあります。</p>
            <p>人によっては体調が良くなかったりどうしてもできない日あるかと思います。</p>
            <p>そこで下位トレーニングの決め方としては</p>
            <p>どの様な環境下でも行える事を選定してください。</p>
            <p>（例：腹筋10回）</p>
            <p>本アプリでは下位トレーニングでも行えば「継続」しているとみなします。</p><br>
            <p>ここで「毎日下位トレーニングを行ってしまうと意味は無いのではないか？」と疑問に上がるかと思います。</p>
            <p>大丈夫です！そうならないようなカラクリを用意しています。</p>
            <p>ここでは簡単にしか述べませんが、毎日トレーニング登録をする事によって円グラフが更新される様になっています。</p>
            <p>具体的な使い方、仕様についてはマイページにあるご利用ガイドを参照してください。</p><br>
            <p>それでは早速、習慣化したい事と３つのトレーニングを登録しましょう！</p>
        </div>
        
        <div class="next-btn">
            <a href="{{ route('training_aim_register') }}">トレーニング登録へ進む</a>
        </div>
        
    </div>
    
    @else
    <div class="content-center main-text">
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
                const ctx1 = document.getElementById('myChart1');
                const daysInMonth = {{ $daysInMonth }};
                const action_count = {{ $action_count }};
                const data1 = [action_count, daysInMonth - action_count];
                new Chart(ctx1, {
                    type: 'doughnut',
                    data: {
                        datasets: [{
                            data: data1,
                            borderWidth: 1
                        }]
                    },
                    options: {
                        plugins: {
                            doughnut: {
                                centerText: {
                                    text: 'My Text', /*試しに入れてみたけど表示されない*/
                                    color: '#000',
                                    fontStyle: 'Arial',
                                    sidePadding: 20,
                                    fontSize: 16
                                }
                            }     
                        }
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
                    type: 'pie',
                    data: {
                        datasets: [{
                        data: data2,
                        borderWidth: 1
                        }]
                    },
                    options: {
                        tooltips: {
                            callbacks: {
                                label: function(tooltipItem, data) {
                                    var label = data.datasets[0].data[tooltipItem.index];
                                    return label + ': ' + actiontype_B_count;
                                }
                            }
                        }
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
                <p>「今日のトレーニングはまだ完了していません」</p>  
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
                <p>今日のトレーニングは完了しています。</p>
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
    
    @endif
    
@endsection