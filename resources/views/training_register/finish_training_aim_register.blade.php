@extends('layouts.layout')

@section('title', '目標/アクション登録完了')

@section('content')
    <div class="training-form">
        <div>
            <h2>トレーニング登録完了</h2>
        </div>
        <div>
            <p>今日行ったトレーニングを登録しましょう！</p>
        </div>
        
        <div>
            <p><a href="{{ route('home.mypage') }}">マイページへ</a></p>
        </div>
    </div>
    
@endsection