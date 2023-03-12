@extends('layouts.after_login_layout')

@section('title', 'ご利用ガイド')

@section('content')
    <div>
        <h1>画面：ご利用ガイド</h1>
        <a>この画面はご利用ガイドです。</a>
        <br>
        <!-- CSSでボタン表示 -->
        <a href="{{ route('home.mypage') }}">マイページ</a>
    </div>
@endsection