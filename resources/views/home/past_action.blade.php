@extends('layouts.layout')

@section('title', '過去履歴１')

@section('content')
    <div class="login-form">
        <div>
            <h2>過去履歴</h2>
        </div>
        <div>
            <table class="table-center">
                @foreach( $all_trainings as $month_training )
                <tr>
                    {{-- リンク押下で$month_trainingのIDが渡される --}}
                    <td><a href="{{ route( 'home.past_pie_chart', ['month_training' => $month_training]) }}">{{ $month_training->training_start_at }} 〜 {{ $month_training->training_finish_at }}</a></td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection