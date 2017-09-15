@extends('layouts.app')

@section('content')
    <div id="container">
        <div id="pad">
            <div class="history">
                <div class="btn-back">
                    <button type="button" class="btn btn-primary" id="btn_undo">１手戻す(F)</button>
                </div>
                <div class="btn-refresh">
                    <button type="button" class="btn btn-primary" id="btn_reset">リセット(R)</button>
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

        <div style="clear:both; padding: 10px;">
            <dl class="board-status">
                <dt>プレイ人数</dt>
                <dd><span id="totalUser"> - </span>人</dd>
                <dt>クリア人数</dt>
                <dd><span id="clearUser"> - </span>人</dd>
                <dt>クリア率</dt>
                <dd><span id="clearRatio"> - </span>％</dd>
            </dl>

            <p>
                <button type="button" class="btn btn-primary" onclick="location.href='/single'">別の問題へ</button>
            </p>
        </div>
    </div>

    <div id="board">
        <canvas id="c"></canvas>
    </div>

    <input type="hidden" id="userCode" value="{{ request()->user()->code }}">
    <input type="hidden" id="boardCode" name="boardCode" value="{{ $boardCode }}">

@endsection