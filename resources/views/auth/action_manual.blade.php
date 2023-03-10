@extends('layouts.before_login_layout')

@section('title', 'アクション登録の説明')

@section('content')
    <div>
        <div>
            <h1>アクション登録の説明画面</h1>
        </div>
        <div>
            <p>アクション登録の説明。アクション登録の説明。<br>それではアクションを登録しましょう！</p>
        </div>
        <div>
            <a href="{{ url('home/action_register') }}">アクション登録へ</a>
        </div>
    </div>
@endsection
