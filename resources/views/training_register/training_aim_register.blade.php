@extends('layouts.before_login_layout')

@section('title', '目標/トレーニング登録')

@section('content')
    <div>
        <div>
            <h1>目標/トレーニング登録画面</h1>
        </div>
        
        {{-- エラーがあれば表示 --}}
        <form action="{{ route('finish_training_aim_register') }}" method="post">
            @csrf
            @if (count($errors) > 0)
                <ul>
                    @foreach($errors->all() as $e)
                        <li>{{ $e }}</li>
                    @endforeach
                </ul>
            @endif
            
            <div>
                <label>習慣化したいこと</label>
                <div>
                    <input type="text" name="training_aim" value="{{ old('training_aim') }}" size="30"><br>
                </div>
            </div>
            
            <div>
                <label>基本トレーニング</label>
                <div>
                    <input type="text" name="training_aim_base" value="{{ old('training_aim_base') }}" size="30"><br>
                </div>
            </div>
            
            <div>
                <label>上位トレーニング</label>
                <div>
                    <input type="text" name="training_aim_upper" value="{{ old('training_aim_upper') }}" size="30"><br>
                </div>
            </div>
            
            <div>
                <label>下位トレーニング</label>
                <div>
                    <input type="text" name="training_aim_lower" value="{{ old('training_aim_lower') }}" size="30"><br>
                </div>
            </div>
            
            {{-- トレーニング登録用のボタン--}}
            <input type="submit" value="登録">
            
        </form>
    </div>
@endsection

