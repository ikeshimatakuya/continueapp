@extends('layouts.layout')

@section('title','ログイン')


@section('content')
    <div class="text-center">
        <div class="">
            <h2>{{ __('messages.login') }}</h2>
        </div>
    
        <div>
            <!-- ログイン後、マイページへ遷移 -->
            <form class="" method="POST" action="{{ route('login') }}">          
            <!-- リクエストを送信しているのがログインを行なったユーザーかどうか確認 -->
            @csrf
                <div id="textbox-email">
                    <p>
                        <input id="email" type="email" placeholder="Email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
                    </p>
                </div>
                
                @if ($errors->has('email'))
                    <span>
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
                
                <br>
                
                <div id="textbox-password">
                    <p>
                        <input id="password" type="password" placeholder="Password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                    </p>
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
            
            </form>
        
            <div id=""> <!-- パスワード再設定は後半実装 -->
                <a>パスワードをお忘れの方はこちら</a>
            </div>
        
            <div id="">
                <a href="{{ route('register') }}">会員登録はこちら</a>
            </div>
        </div>
    </div>
@endsection