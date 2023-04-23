@extends('layouts.layout')

@section('title', '目標/アクション登録完了')

@section('content')
    <div class="login-form">
        <div>
            <h2>トレーニング登録完了</h2>
        </div>
        <div class="guide-text">
            <p>今日行ったトレーニングを登録しましょう！</p>
        </div>
        
        <div class="form-text">
            <p><a href="{{ route('home.mypage') }}">マイページへ</a></p>
        </div>
    </div>
    
@endsection