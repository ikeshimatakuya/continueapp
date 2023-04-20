@extends('layouts.layout')

@section('title', '各種設定')

@section('content')
<div class="register-form">
    <form method="POST" action="{{ route('home.setting') }}">
        @csrf
        @method('PUT')
        
        <h2>各種設定</h2>
        
        <p>ユーザーID：{{ $user_id }}</p>
        
        <p>退会機能実装予定</p>
        <p>メール通知機能実装予定</p>
        <p>パスワード再設定機能実装予定</p>
        
        <div class="checkbox">
            <input type="submit" value="変更">
        </div>
        
    </form>
</div>
    
@endsection