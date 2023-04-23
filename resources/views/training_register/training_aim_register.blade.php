@extends('layouts.layout')

@section('title', 'トレーニング登録')

@section('content')
    <div>
        
        {{-- 月が切り替わってトレーニング登録する際に --}}
        
        {{-- エラーがあれば表示 --}}
        <div class="login-form">
            
            <form action="{{ route('finish_training_aim_register') }}" method="post">
                @csrf
                
                <h2>習慣化する事の登録</h2>
                
                @if (count($errors) > 0)
                    <ul>
                        @foreach($errors->all() as $e)
                            <li>{{ $e }}</li>
                        @endforeach
                    </ul>
                @endif
            
                <div class="form-group">
                    <label>習慣化したいこと</label>
                    <div>
                        <input type="text" name="training_aim" value="{{ old('training_aim') }}" size="30"><br>
                    </div>
                </div>
            
                <div class="form-group">
                    <label>基本トレーニング</label>
                    <div>
                        <input type="text" name="training_aim_base" value="{{ old('training_aim_base') }}" size="30"><br>
                    </div>
                </div>
            
                <div class="form-group">
                    <label>上位トレーニング</label>
                    <div>
                        <input type="text" name="training_aim_upper" value="{{ old('training_aim_upper') }}" size="30"><br>
                    </div>
                </div>
            
                <div class="form-group">
                    <label>下位トレーニング</label>
                    <div>
                        <input type="text" name="training_aim_lower" value="{{ old('training_aim_lower') }}" size="30"><br>
                    </div>
                </div>
                
                <div>
                    <p>※一度登録すると来月になるまで変更できません。</p>
                </div>
            
                <div class="checkbox">
                    <button type="submit">登録</button>
                </div>

            </form>
            
        </div>
    </div>
@endsection

