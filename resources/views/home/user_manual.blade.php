@extends('layouts.layout')

@section('title', 'ご利用ガイド')

@section('content')
    <div class="start-guide">
        <h2>ご利用ガイド</h2>
        <div class="guide-text">
            <ul>
                <li>あ</li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
            </ul>
        </div>
        
        <!-- CSSでボタン表示 -->
        <a href="{{ route('home.mypage') }}">マイページ</a>
    </div>
@endsection