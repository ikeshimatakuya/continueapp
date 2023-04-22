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
        <link href="{{ secure_asset('css/app.css') }}" rel="stylesheet">
        <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script> 
        
        {{-- 各画面のCSSを読み込み --}}
        <link href="{{ secure_asset('css/.css') }}" rel="stylesheet">
        <link href="{{ secure_asset('css/mypage.css') }}" rel="stylesheet">
        <link href="{{ secure_asset('css/auth.css') }}" rel="stylesheet">
        <link href="{{ secure_asset('css/responsive.css') }}" rel="stylesheet">
    </head>
    
    <body>
        <div id="munu">
            <header class="header-wrapper container">
                <h1>
                    <a href="{{ route('home.mypage') }}">{{ config('app.name') }}</a>
                </h1>
                <nav>
                    <ul class="navbar">
                        @guest
                        <li>
                            <a href="{{ route('login') }}">ログイン</a>
                        </li>
                        @else
                        <li>
                            <a href="{{ route('home.mypage') }}">マイページ</a>
                        </li>
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
                    </ul>
                </nav>
            
                <nav class="sp-navbar" id="navbar">
                    <ul>
                        @guest
                        <li>
                            <a href="{{ route('login') }}">ログイン</a>
                        </li>
                        @else
                        <li>
                            <a href="{{ route('home.mypage') }}">マイページ</a>
                        </li>
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
                        <li class="close">
                            <span>閉じる</span>
                        </li>
                        @endguest
                    </ul>
                </nav>
                <div id="hamburger-menu">
                    <span></span>
                </div>
            </header>
        </div>
        

        <main class="main-wrapper container">
            @yield('content')
        </main>
        
        <script>
            $(function(){
                const hamburger = $('#hamburger-menu,.close')
                const nav = $('.sp-navbar')
                hamburger.on('click',function(){
                    nav.toggleClass('open');
                });
            });
        </script>
    </body>
</html>