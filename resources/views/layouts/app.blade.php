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
                        <li><a href="{{ url('/single') }}">問題を解く</a></li>
                        <li><a href="{{ url('/single/stamps') }}">すたンプ</a></li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="/howto"><i class="fa fa-question-circle-o" aria-hidden="true"></i> 遊び方</a></li>

                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                <span id="nameLabel">{{ request()->user()->name }}</span> <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a href="#" onclick="openRenameModal();">
                                        名前変更
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
            <span class="text-muted">ver. 20170917_0900 <span style="margin-left:10px;"> / 作：会長 ( <a href="https://twitter.com/etude_kaicho" target="_blank" style="color:#99F"><i class="fa fa-twitter" aria-hidden="true"></i> Twitter</a> / <a href="http://peercasket.herokuapp.com/2017a/circle/2825" target="_blank" style="color:#99F">きゃすけっと特設ページ</a> )</span></span>
        </div>
    </footer>

    <!-- Modal -->
    <div class="modal fade" id="renameModal" tabindex="-1" role="dialog" aria-labelledby="renameModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="userUpdateForm">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">プロフィール編集</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="userName">名前（20文字以内）</label>
                            <input type="text" class="form-control" id="userName" value="{{ request()->user()->name }}" maxlength="20">
                            <input type="hidden" id="userCode" value="{{ request()->user()->code }}">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">キャンセル</button>
                        <button type="submit" class="btn btn-primary">決定</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ mix('js/lib.js') }}"></script>
    <script src="{{ mix('js/single.js') }}"></script>
</body>
</html>
