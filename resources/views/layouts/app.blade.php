<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>はいぱーすたちゅー：詰すた</title>

    <!-- Styles -->
    <link rel="stylesheet" type="text/css" href="{{ mix('css/single.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ mix('css/lib.css') }}">
    <link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/single') }}">
                        {{ config('app.name', '') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->


                    <ul class="nav navbar-nav navbar-left">
                        <li><a href="">ランダム</a></li>
                        <li><a href="">初級</a></li>
                        <li><a href="">中級</a></li>
                        <li><a href="">上級</a></li>
                        <li><a href="">超級</a></li>

                        {{--<li class="dropdown">--}}
                            {{--<a class="dropdown-toggle" data-toggle="dropdown" href="#" id="download">Slate <span class="caret"></span></a>--}}
                            {{--<ul class="dropdown-menu" aria-labelledby="download">--}}
                                {{--<li><a href="http://jsfiddle.net/bootswatch/g1q7jxzf/">Open Sandbox</a></li>--}}
                                {{--<li class="divider"></li>--}}
                                {{--<li><a href="./bootstrap.min.css">bootstrap.min.css</a></li>--}}
                                {{--<li><a href="./bootstrap.css">bootstrap.css</a></li>--}}
                                {{--<li class="divider"></li>--}}
                                {{--<li><a href="./variables.less">variables.less</a></li>--}}
                                {{--<li><a href="./bootswatch.less">bootswatch.less</a></li>--}}
                                {{--<li class="divider"></li>--}}
                                {{--<li><a href="./_variables.scss">_variables.scss</a></li>--}}
                                {{--<li><a href="./_bootswatch.scss">_bootswatch.scss</a></li>--}}
                            {{--</ul>--}}
                        {{--</li>--}}
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href=""><i class="fa fa-question-circle-o" aria-hidden="true"></i> 遊び方</a></li>

                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ request()->user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#">すたンプ</a></li>
                                <li class="divider"></li>
                                <li>
                                    <a href="#">
                                        プロフィール編集
                                    </a>

                                    <form id="logout-form" action="" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container">
            @yield('content')
        </div>
    </div>

    <footer class="footer clearfix">
        <div class="container" style="margin-top:10px; text-align: center;">
            <span class="text-muted">ver. 20170916_0000 <span style="margin-left:10px;"> / 作：会長 ( <a href="https://twitter.com/etude_kaicho" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i> Twitter</a> / <a href="#">きゃすけっと特設ページ</a> )</span></span>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="{{ mix('js/lib.js') }}"></script>
    <script src="{{ mix('js/single.js') }}"></script>
</body>
</html>
