<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>はいぱーすたちゅー</title>
    <!-- Styles -->
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
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', '') }}
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->

                <!-- Right Side Of Navbar -->
            </div>
        </div>
    </nav>

    <div class="container">
        <p>このサイトは、「<a href="http://peercasket.herokuapp.com/2017a/" target="_blank">きゃすけっと2017秋</a>」用に作成したゲームサイトでした。</p>
    </div>

    <footer class="footer clearfix">
        <div class="container" style="margin-top:10px; text-align: center;">
            <span class="text-muted">ver. 20170917_0900 <span style="margin-left:10px;"> / 作：会長 ( <a href="https://twitter.com/etude_kaicho" target="_blank" style="color:#99F"><i class="fa fa-twitter" aria-hidden="true"></i> Twitter</a> )</span></span>
        </div>
    </footer>

</div>
</body>
</html>
