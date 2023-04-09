@extends('layouts.after_login_layout')

@section('title', '過去履歴１')

@section('content')
    <div>
        <div>
            <h2>過去履歴</h2>
        </div><br>

        <div>
            <table>
                @foreach( $all_trainings as $month_training )
                <tr>
                    {{-- リンク押下で$month_trainingのIDが渡される --}}
                    <td><a href="{{ route( 'home.past_pie_chart', ['month_training' => $month_training]) }}">{{ $month_training->training_start_at }} 〜 {{ $month_training->training_finish_at }}</a></td>
                </tr>
                @endforeach
            </table>
        </div><br>    

        <div>
            <a href="{{ route( 'home.mypage' ) }}">マイページへ戻る</a>
        </div>
    </div>
@endsection