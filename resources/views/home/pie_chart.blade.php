@extends('layouts.after_login_layout')

@section('title', '過去履歴２')

@section('content')
    <div>
        <div>
            <h2>画面：過去履歴２</h2>
        </div>
        <div>
            <div>
                <h3>日付</h3><br>
            </div>
            <div>
                <div>
                    <p>円グラフ表示１</p>
                </div>
                <div>
                    <p>円グラフ表示２</p><br>
                </div>
            </div>
            <div>
                <input type="button" onclick="history.back()" value="戻る">
            </div>
        </div>
    </div>
@endsection
