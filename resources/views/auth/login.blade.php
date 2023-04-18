@extends('layouts.layout')

@section('title','ログイン')


@section('content')

    <div class="login-form">
        <form action="{{ route('login') }}" method="POST">
        @csrf
            
            <h2>{{ __('messages.login') }}</h2>
            
            <div class="form-group">
                <label for="email">{{ __('messages.email') }}:</label>
                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
            </div>
                
            @if ($errors->has('email'))
                <span>
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
            
            <div class="form-group">
                <label for="password">{{ __('messages.password') }}:</label>
                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
            </div>
            
            @if ($errors->has('password'))
                <span>
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
            
            <div>
                <label>
                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('messages.remember_me') }}
                </label>
            </div>
            
            <div class="checkbox">
                <button type="submit">
                    {{ __('messages.login') }}
                </button>
            </div>

            <div id="member-register">
                <a href="{{ route('register') }}">会員登録はこちら</a>
            </div>
            
        </form>
    </div>
    
@endsection