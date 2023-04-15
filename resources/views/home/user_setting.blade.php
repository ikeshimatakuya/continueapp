@extends('layouts.layout')

@section('title', '各種設定画面')

@section('content')
    <form method="POST" action="{{ route('home.setting') }}">
        @csrf
        @method('PUT')
        
        <p>ユーザーID：{{ $user_id }}</p>



        <input type="submit" value="変更">
    </form>
@endsection