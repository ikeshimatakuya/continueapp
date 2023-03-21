@extends('layouts.before_login_layout')

@section('title', '目標/アクション登録完了')

@section('content')
    <def>
        <b2>アクション登録完了画面</b2>
        <p>アクション登録が完了しました</p>
        
        <a href="{{ route('home.mypage') }}">マイページへ</a>
    </def>
@endsection