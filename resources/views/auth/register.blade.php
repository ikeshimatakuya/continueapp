@extends('layouts.layout')

@section('title','会員登録')

@section('content')

    <div class="register-form">
        <form action="{{ route('register') }}" method="POST">
            @csrf
            
            <h2>{{ __('messages.register') }}</h2>
            
            <div class="form-group">
                <label for="email">{{ __('messages.email') }}:</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="password">{{ __('messages.password') }}:</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                
                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="password_confirmation">{{ __('messages.confirm_password') }}:</label>
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
            </div>
            
            <div class="checkbox">
                <button type="submit">
                    {{ __('messages.register') }}
                </button>
            </div>
            

        </form>
    </div>

@endsection
