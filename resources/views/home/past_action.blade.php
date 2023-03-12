@extends('layouts.after_login_layout')

@section('title', '過去履歴１')

@section('content')
    <div>
        <div>
            <h2>画面：過去履歴１画面</h2>
        </div>
        <div>
            <!-- テーブルのセルにリンク埋め込むのどうやってするんやろか？ -->
            <table>
                <a href="{{ route('home.pie_chart')}}">（例）2023/01/01 ~ 2023/01/31</a>
                <tr>
                    <td>（例）2023/01/01 ~ 2023/01/31</td>
                </tr>
                <tr>
                    <td>（例）2023/01/01 ~ 2023/01/31</td>
                </tr>
            </table>
        </div>
        <div>
            <a href="{{ route('home.mypage') }}">マイページへ戻る</a>
        </div>
    </div>
@endsection