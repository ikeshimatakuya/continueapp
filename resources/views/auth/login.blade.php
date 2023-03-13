@extends('layouts.before_login_layout')

@section('title','ログイン')

@section('content')
    <h2>ログイン画面</h2>
    <div>{{ __('messages.login') }}</div>
    <div>
        <!-- ログイン後、マイページへ遷移 -->
        <form method="POST" action="{{ route('home.mypage') }}">
        <!-- リクエストを送信しているのがログインを行なったユーザーかどうか確認 -->
        @csrf
            <div>
                <label for="email">{{ __('messages.email') }}</label>
                <div>
                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
                    
                    @if ($errors->has('email'))
                        <span>
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                    
                </div>
            </div>

            <div>
                <label>{{ __('messages.password') }}</label>
                <div>
                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                    @if ($errors->has('password'))
                        <span>
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div>
                <label>
                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('messages.remember_me') }}
                </label>
            </div>

            <div>
                <button type="submit">
                    {{ __('messages.login') }}
                </button>
            </div>
            
        </form>
        
        <br>
        <div>
            <!-- パスワード再設定は後半実装 -->
            <a>パスワードをお忘れの方はこちら</a>
        </div>
        
        <br>
        <div>
            <a href="{{ route('register') }}">会員登録はこちら</a>
        </div>
        
    </div>
    
@endsection