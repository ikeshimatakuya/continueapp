@extends('layouts.before_login_layout')

@section('title', '目標/アクション登録')

@section('content')
    <div>
        <div>
            <h1>目標/アクション登録画面</h1>
        </div>
        <form action="{{ route('auth.finish_action_register') }}">
            <input type="text" name="message"><br>
            <input type="submit" value="送信">
        </form>
    </div>
@endsection

