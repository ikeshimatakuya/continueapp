@extends('layouts.before_login_layout')

@section('title', '会員登録完了')

@section('content')
    <div>
        <div>
            <h1>会員登録完了画面</h1>
        </div>
        <div>
            <p>会員登録完了しました。次にアクション登録の説明をします。</p><br>
            <p>ああああああああ<br>それではアクション登録をしましょう！</p>
        </div>
        <div>
            <a href="{{ route('auth.action_register') }}">アクション登録の説明へ</a>
        </div>
    </div>
@endsection
