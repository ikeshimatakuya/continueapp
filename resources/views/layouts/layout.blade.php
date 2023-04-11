<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        {{-- 各ページごとにtitleタグを入れるために@yieldで空けておきます。 --}}
        <title>@yield('title')</title>

        <!-- Scripts -->
         {{-- Laravel標準で用意されているJavascriptを読み込みます --}}
        <script src="{{ secure_asset('js/app.js') }}" defer></script>
        {{-- chart.jsの読み込み --}}
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        
        <!-- Fonts -->
        <link rel="dns-prefetch" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        {{-- Laravel標準で用意されているCSSを読み込みます --}}
        <link href="{{ secure_asset('css/app.css') }}" rel="stylesheet">
        {{-- この章の後半で作成するCSSを読み込みます(作成)--}}
        <link href="{{ secure_asset('css/admin.css') }}" rel="stylesheet">

    </head>
    <body>
        <div>
            <header>
                
                <h1>
                    <a href="{{ route('home.mypage') }}">{{ config('app.name') }}</a>
                </h1>
                
                <nav>
                    <!-- Authentication Links -->
                    {{-- ログインしていなかったらログイン画面へのリンクを表示 --}}
                    @guest
                    <li>
                        <a href="{{ route('login') }}">ログイン</a>
                    </li>

                    @else
                    <li>
                        <a href="{{ route('home.past_history') }}">過去履歴</a>
                    </li>
                    <li>
                        <a href="{{ route('home.setting') }}">各種設定</a>
                    </li>
                    <li>
                        <a href="{{ route('home.user_manual') }}">ご利用ガイド</a>
                    </li>
                    <li>
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();"
                            data-method="POST">
                            ログアウト
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                    @endguest
                </nav>

            </header>
            
            <main>
                @yield('content')
            </main>
            
        </div>
    </body>
</html>