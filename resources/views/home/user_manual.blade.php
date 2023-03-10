@extends('layouts.after_login_layout')

@section('title', 'ご利用ガイド')

@section('content')
    <div>
        <h1>画面：ご利用ガイド</h1>
        <a>この画面はご利用ガイドです。</a>
        <br>
        <input type="button" onclick="{{ url('home/mypage') }}" value="マイページ">
    </div>
@endsection