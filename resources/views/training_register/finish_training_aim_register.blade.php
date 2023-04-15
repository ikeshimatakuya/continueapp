@extends('layouts.layout_register')

@section('title', '目標/アクション登録完了')

@section('content')
    <def>
        <b2>トレーニング登録完了画面</b2><br>
        <p>トレーニング登録が完了しました</p>
        
        <a href="{{ route('home.mypage') }}">マイページへ</a>
    </def>
@endsection