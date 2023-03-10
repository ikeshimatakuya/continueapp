@extends('layouts.after_login_layout')

@section('title', '各種設定画面')

@section('content')
    <h2>画面：各種設定</h2>
    
    <!-- post使った送信方法わからんかったし質問。先にDB作らなあかんかも-->
    <form action="{{ url('home/mypage') }}">
        <input type="submit" value="送信">
    </form>
@endsection