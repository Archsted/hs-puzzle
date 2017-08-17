<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8" />
    <title>はいぱーすたちゅー（おひとりモード）</title>
    <base href="{{ env('APP_URL') }}">
    <link rel="stylesheet" type="text/css" href="css/single.css">
    <link rel="stylesheet" href="lib/font-awesome-4.7.0/css/font-awesome.min.css">
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/fabric.min.js"></script>
</head>
<body>
<header>
    駒のすたちゅー画像が表示されないなど、表示がおかしい場合はリロードしてみてください。
</header>
<div id="main">

    <div id="container">

        <div id="pad">
            <div class="history">
                <div class="btn-back">
                <span class="btn fa-stack fa-lg">
                    <i class="fa fa-square-o fa-stack-2x"></i>
                    <i class="fa fa-undo fa-stack-1x"></i>
                </span>
                </div>
                <div class="btn-refresh">
                <span class="btn fa-stack fa-lg">
                    <i class="fa fa-square-o fa-stack-2x"></i>
                    <i class="fa fa-refresh fa-stack-1x"></i>
                </span>
                </div>
            </div>

            <div>
                <div class="arrow-pad red" data-sta-color="red" style="float:left; margin-left:10px;">
                    <div style="text-align:center;">
                        <button class="arrows moveUp" value="red">
                            <i class="fa fa-arrow-circle-up fa-2x"></i>
                        </button>
                    </div>
                    <div style="height:33px;">
                        <div style="float:left;height:33px;">
                            <button class="arrows moveLeft" value="red">
                                <i class="fa fa-arrow-circle-left fa-2x"></i>
                            </button>
                        </div>
                        <div style="float:right;height:33px;">
                            <button class="arrows moveRight" value="red">
                                <i class="fa fa-arrow-circle-right fa-2x"></i>
                            </button>
                        </div>
                    </div>
                    <div style="clear:both; text-align:center;">
                        <button class="arrows moveDown" value="red">
                            <i class="fa fa-arrow-circle-down fa-2x"></i>
                        </button>
                    </div>
                </div>

                <div class="arrow-pad green" data-sta-color="green" style="float:right; margin-right:10px;">
                    <div style="text-align:center;">
                        <button class="arrows moveUp" value="green">
                            <i class="fa fa-arrow-circle-up fa-2x"></i>
                        </button>
                    </div>
                    <div>
                        <div style="float:left;">
                            <button class="arrows moveLeft" value="green">
                                <i class="fa fa-arrow-circle-left fa-2x"></i>
                            </button>
                        </div>
                        <div style="float:right;">
                            <button class="arrows moveRight" value="green">
                                <i class="fa fa-arrow-circle-right fa-2x"></i>
                            </button>
                        </div>
                    </div>
                    <div style="clear:both; text-align:center;">
                        <button class="arrows moveDown" value="green">
                            <i class="fa fa-arrow-circle-down fa-2x"></i>
                        </button>
                    </div>
                </div>
            </div>

            <div style="clear:both;">
                <div class="arrow-pad blue" data-sta-color="blue" style="float:left; margin-left:10px;">
                    <div style="text-align:center;">
                        <button class="arrows moveUp" value="blue">
                            <i class="fa fa-arrow-circle-up fa-2x"></i>
                        </button>
                    </div>
                    <div>
                        <div style="float:left;">
                            <button class="arrows moveLeft" value="blue">
                                <i class="fa fa-arrow-circle-left fa-2x"></i>
                            </button>
                        </div>
                        <div style="float:right;">
                            <button class="arrows moveRight" value="blue">
                                <i class="fa fa-arrow-circle-right fa-2x"></i>
                            </button>
                        </div>
                    </div>
                    <div style="clear:both; text-align:center;">
                        <button class="arrows moveDown" value="blue">
                            <i class="fa fa-arrow-circle-down fa-2x"></i>
                        </button>
                    </div>
                </div>

                <div class="arrow-pad yellow" data-sta-color="yellow" style="float:right; margin-right:10px;">
                    <div style="text-align:center;">
                        <button class="arrows moveUp" value="yellow">
                            <i class="fa fa-arrow-circle-up fa-2x"></i>
                        </button>
                    </div>
                    <div>
                        <div style="float:left;">
                            <button class="arrows moveLeft" value="yellow">
                                <i class="fa fa-arrow-circle-left fa-2x"></i>
                            </button>
                        </div>
                        <div style="float:right;">
                            <button class="arrows moveRight" value="yellow">
                                <i class="fa fa-arrow-circle-right fa-2x"></i>
                            </button>
                        </div>
                    </div>
                    <div style="clear:both; text-align:center;">
                        <button class="arrows moveDown" value="yellow">
                            <i class="fa fa-arrow-circle-down fa-2x"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>


    </div>


    <div id="board">
        <canvas id="c"></canvas>
    </div>

    <div id="footer">
        <button id="howtoToggle">遊び方を表示 / 非表示</button> ver. 20170319_0850 <span style="margin-left:10px;"> / 作：会長（<a href="https://twitter.com/etude_kaicho" target="_blank">twitter</a>）</span>
        <ul class="fa-ul" id="howto" style="display:none;">
            <li><i class="fa-li fa fa-check-square-o"></i>うどんに同じ色のすたちゅーを連れていこう。<strong>うどんが灰色の場合、連れていくのは何色でもいいよ。</strong></li>
            <li><i class="fa-li fa fa-check-square-o"></i>左側パッド部分で各色のすたちゅーが動くよ。<strong>一度動くと壁か他のすたちゅーにぶつかるまで止まらないよ。</strong></li>
            <li><i class="fa-li fa fa-check-square-o"></i><strong style="text-decoration: underline;">左側パッドの各色エリアにマウスカーソルを載せたままキーボードの [ASDW] や [←↓→↑] を押しても移動できるよ。</strong></li>
            <li><i class="fa-li fa fa-check-square-o"></i>パッド上にある矢印ボタンは、左が「一手戻る」、右が「全て戻る」だよ。<br>
                <strong style="text-decoration: underline;">一手戻るはキーボードの「F」、全て戻るは「R」を押してもいけるよ。</strong></li>
        </ul>
    </div>
</div>

<input type="hidden" id="userCode" value="{{ $userCode }}">
<input type="hidden" id="boardCode" name="boardCode" value="{{ $boardCode }}">
<script src="js/single.js"></script>
</body>
</html>