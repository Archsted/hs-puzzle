var canvas;

var map = [];
var original;

var udon = {};
var stas = {};
var token;

var logList = [];

var maxStep = -1;

var settings;

var isGoal = false;
var staCount = 0;

var socket = null;

var hoverColor = '';

var CellType = {
    None: 0,
    Wall: 1
};

var CellColor = {
    red: '#f22',
    green: '#2f2',
    blue: '#88f',
    yellow: '#fd2',
    black: '#999'
};

var MoveDirection = {
    Up: 1,
    Right: 2,
    Down: 3,
    Left: 4
};


var redStaObject;
var greenStaObject;
var blueStaObject;
var yellowStaObject;

var udonObject;
var wallObjects = [];
var stepCountObject;
var loadingBgObject;
var loadingTextObject;

var state;

function Sta () {
    this.oh = 0; //初期位置
    this.ow = 0;

    this.lh = 0; //移動中の一時的座標
    this.lw = 0;

    this.h = 0; //現在位置
    this.w = 0;

    this.color = '';

    this.setDefaultPosition = function(defH, defW) {
        this.oh = this.lh = this.h = defH;
        this.ow = this.lw = this.w = defW;
    };

    this.getPosId = function(h, w) {
        return '#c' + h + '_' + w;
    };

    this.moveUp = function () {
        if (staCount <= 0) {
            return;
        }

        var tw = this.w, th = this.h;

        this.setLastPosition();

        while (this.canMove(th - 1, tw) && (map[th - 2][tw] == 0)) {
            th -= 2;
        }

        if (this.h != th) {
            decrementStaCount();
            this.h = th;
            this.show();
            log(this, MoveDirection.Up);
        }
    };

    this.moveRight = function () {
        if (staCount <= 0) {
            return;
        }

        var tw = this.w, th = this.h;

        this.setLastPosition();

        while (this.canMove(th, tw + 1) && (map[th][tw + 2] == 0)) {
            tw += 2;
        }

        if (this.w != tw) {
            decrementStaCount();
            this.w = tw;
            this.show();
            log(this, MoveDirection.Right);
        }
    };

    this.moveDown = function () {
        if (staCount <= 0) {
            return;
        }

        var tw = this.w, th = this.h;

        this.setLastPosition();

        while (this.canMove(th + 1, tw) && (map[th + 2][tw] == 0)) {
            th += 2;
        }

        if (this.h != th) {
            decrementStaCount();
            this.h = th;
            this.show();
            log(this, MoveDirection.Down);
        }
    };

    this.moveLeft = function () {
        if (staCount <= 0) {
            return;
        }

        var tw = this.w, th = this.h;

        this.setLastPosition();

        while (this.canMove(th, tw - 1) && (map[th][tw - 2] == 0)) {
            tw -= 2;
        }

        if (this.w != tw) {
            decrementStaCount();
            this.w = tw;
            this.show();
            log(this, MoveDirection.Left);
        }
    };

    this.canMove = function(h, w) {
        return (map[h][w] == 0);
    };

    this.setLastPosition = function() {
        this.lh = this.h;
        this.lw = this.w;
    };

    this.show = function() {

        map[this.lh][this.lw] = 0;
        map[this.h][this.w] = 2;

        switch (this.color) {
            case 'red':
                staObject = redStaObject;
                break;
            case 'green':
                staObject = greenStaObject;
                break;
            case 'blue':
                staObject = blueStaObject;
                break;
            case 'yellow':
                staObject = yellowStaObject;
                break;
        }

        staObject.set({
            left: cWidth(this.w),
            top: cHeight(this.h)
        });

        canvas.renderAll();

        var trackPoint = [cWidth(this.lw)+6, cHeight(this.lh)+6, cWidth(this.w)+6, cHeight(this.h)+6];
        if (this.lw > this.w) { //右から左へ移動
            trackPoint[0] += 20;
        }
        if (this.lh > this.h) { //下から上へ移動
            trackPoint[1] += 20;
        }

        var track = new fabric.Line(trackPoint, {
            opacity: 0.6,
            stroke: CellColor[this.color],
            fill: CellColor[this.color],
            strokeWidth: 20
        });
        track.animate('opacity', 0, {
            onChange: canvas.renderAll.bind(canvas),
            duration: 800,
            onComplete: function() {
                canvas.remove(track);
            },
            easing: fabric.util.ease.easeOutExpo
        });

        canvas.add(track);
    };
}

$(function(){
    preload();

    initBoard();
//    connectServer();

    //canvas上で不要なコンテキストメニューが出ないようにする
    $('canvas').on('contextmenu', function(e){
        return false;
    });

    reload();

    $('.moveUp').click(function(){
        if (isGoal || !isPlayable() || staCount <= 0) return false;
        var sta = stas[this.value];
        sta.moveUp();
        checkGetUdon(sta);
    });
    $('.moveRight').click(function(e){
        if (isGoal || !isPlayable() || staCount <= 0) return false;
        var sta = stas[this.value];
        sta.moveRight();
        checkGetUdon(sta);
    });
    $('.moveDown').click(function(e){
        if (isGoal || !isPlayable() || staCount <= 0) return false;
        var sta = stas[this.value];
        sta.moveDown();
        checkGetUdon(sta);
    });
    $('.moveLeft').click(function(e){
        if (isGoal || !isPlayable() || staCount <= 0) return false;
        var sta = stas[this.value];
        sta.moveLeft();
        checkGetUdon(sta);
    });

    $('.fa-refresh, .fa-cog').hover(
        function(){
            $(this).addClass('fa-spin');
        },
        function(){
            $(this).removeClass('fa-spin');
        }
    );

    $('.fa-stack').click(function(){
        if (isPlayable()) {
            undo();
        }
    });
    $('.fa-refresh').click(function(){
        if (isPlayable()) {
            reset();
        }
    });

    $('#howtoToggle').click(function(){
        $('#howto').slideToggle('fast');
    });

    $('.arrow-pad').hover(
        function(){
            hoverColor = $(this).data('sta-color');
        },
        function(){
            if (hoverColor != '') {
                hoverColor = '';
            }
        }
    );

    $(window).keydown(function(e){
        var funcName = {
            65:'moveLeft',
            83:'moveDown',
            68:'moveRight',
            87:'moveUp',
            37:'moveLeft',
            40:'moveDown',
            39:'moveRight',
            38:'moveUp'
        };

        if (hoverColor == '') {
            return;
        }
        switch (e.keyCode) {
            case 37: //←
            case 38: //↑
            case 39: //→
            case 40: //↓
            case 65: //A
            case 83: //S
            case 68: //D
            case 87: //W
                $('button.' + funcName[e.keyCode]).filter(function(index) {return $(this).val() == hoverColor;}).click();
                return false;
                break;
            case 82: //R
                if (isPlayable()) {
                    reset();
                }
                break;
            case 70: //F
                if (isPlayable()) {
                    undo();
                }
                break;
            default:
        }
    });

});

function initBoard () {
    canvas = new fabric.StaticCanvas('c', {
        width: 580,
        height: 580
    });

    canvas.setBackgroundColor({
        source: 'img/board_background.png',
        repeat: 'repeat'
    }, canvas.renderAll.bind(canvas));

    stepCountObject = new fabric.Text("--", {
        left: cWidth(14) + 6 + 14,
        top: cHeight(14) + 6,
        textAlign: 'center',
        fill: 'yellow',
        fontSize: 50,
        width: 70
        // textShadow: 'rgba(255,255,255,0.3) 5px 5px 5px'
    });

    stepCountObject.adjustPosition('center');

    canvas.add(stepCountObject);
}

function initWall() {

    for (var i = 0; i < wallObjects.length; i++) {
        canvas.remove(wallObjects[i]);
    }

    wallObjects = [];

    for (var h = 0; h < map.length; h++) {
        for (var w = 0; w < map[h].length; w++) {
            if (map[h][w] == CellType.Wall) { //壁だったら

                var wall = new fabric.Rect({
                    left: (Math.floor(w / 2) * 32) + (Math.ceil(w / 2) * 4),
                    top: (Math.floor(h / 2) * 32) + (Math.ceil(h / 2) * 4),
                    width: (w % 2 == 0) ? 4 : 32,
                    height: (h % 2 == 0) ? 4 : 32,
                    fill: 'black',
                    strokeWidth : 0
                });

                wallObjects.push(wall);
                canvas.add(wall);
            }
        }
    }

    //中央のステップ数を壁より前に持ってくる
    stepCountObject.bringToFront();
}


function initStas(data) {

    //現状のcanvas要素を削除
    if (redStaObject) {
        canvas.remove(redStaObject);
    }
    if (greenStaObject) {
        canvas.remove(greenStaObject);
    }
    if (blueStaObject) {
        canvas.remove(blueStaObject);
    }
    if (yellowStaObject) {
        canvas.remove(yellowStaObject);
    }

    $.each(data, function(color, pos) {

        //移動履歴は無視
        if (color == 'move') {
            return;
        }

        stas[color] = new Sta();
        stas[color].color = color;
        stas[color].setDefaultPosition(pos['h'], pos['w']);

        var img = 'sta' + (Math.floor(Math.random() * 8) + 1);

        var staBg = new fabric.Rect({
            left: 0,
            top: 0,
            width: 32,
            height: 32,
            fill: CellColor[color],
            strokeWidth : 0,
            rx: 8,
            ry: 8
        });

        var staImg = new fabric.Image(document.getElementById(img), {
            left: 0,
            top: 0,
            strokeWidth : 0
        });

        var staGroup = new fabric.Group([ staBg, staImg ], {
            left: cWidth(pos['w']),
            top: cHeight(pos['h']),
            strokeWidth : 0
        });

        switch (color) {
            case 'red':
                redStaObject = staGroup;
                break;
            case 'green':
                greenStaObject = staGroup;
                break;
            case 'blue':
                blueStaObject = staGroup;
                break;
            case 'yellow':
                yellowStaObject = staGroup;
                break;
        }

        canvas.add(staGroup);
        stas[color].show();
    });

}

function initUdon() {

    var udonBg = new fabric.Rect({
        left: 0,
        top: 0,
        width: 32,
        height: 32,
        fill: CellColor[udon['color']],
        strokeWidth : 0
    });

    var udonImg = new fabric.Image(document.getElementById('udon'), {
        left: 1,
        top: 1,
        strokeWidth : 0
    });

    var udonGroup = new fabric.Group([ udonBg, udonImg ], {
        left: cWidth(udon['w']),
        top: cHeight(udon['h']),
        strokeWidth : 0
    });

    if (udonObject) {
        canvas.remove(udonObject);
    }
    udonObject = udonGroup;

    canvas.add(udonGroup);

}

function checkGetUdon(sta) {
    if (sta.h == udon['h'] && sta.w == udon['w'] && (sta.color == udon['color'] || udon['color'] == 'black')) {

        // goal
        isGoal = true;

        state = 5;

        // 空にすることで次の読み込みをランダムにする
        $('#boardCode').val('');

        roundOver();

        setTimeout(function(){

            reload();

        }, 1000);
    }
}

function undo() {
    if (logList.length == 0) {
        return;
    }
    else if (logList.length == 1) {
        reset();
        return;
    }

    //ゴールフラグを解除
    isGoal = false;

    //ログリストの最後を削除
    logList.pop();

    $.each(stas, function(color) {
        var sta = stas[color];
        //$(sta.getPosId(sta.h, sta.w)).text('');
        map[sta.h][sta.w] = 0;
    });
    incrementStaCount();
    initStas(logList[logList.length - 1]);
}


function reset() {
    var data = $.extend(true, {}, original);

    isGoal = false;
    logList = [];

    map = data['map'];
    udon = data['udon'];
    token = data['token'];

    initStepCount();
    initStas(data['stas']);
}

function initGame() {
    var data = $.extend(true, {}, original);

    isGoal = false;
    logList = [];
    map = data['map'];
    udon = data['udon'];
    initStepCount();
    initWall();
    initUdon();
    initStas(data['stas']);
}

function initStepCount() {
    staCount = maxStep;
    stepCountObject.setText(staCount.toString());
}

function log(targetSta, direction) {
    var logData = {};
    $.each(stas, function(color) {
        logData[color] = {h:stas[color].h, w:stas[color].w};
    });

    //動かしたものの色と方向
    logData['move'] = {color: targetSta.color, direction: direction};

    logList.push(logData);
}

// プリロード
function preload() {
    var preloadEl = $('<div />')
        .css('display', 'none')
        .attr('id', 'preload');

    //すたちゅー
    for (var i = 1; i <= 8; i++) {
        $('<img/>')
            .attr('src', 'img/sta' + i + '.png')
            .attr('id', 'sta' + i)
            .appendTo(preloadEl);
    }

    //うどん
    $('<img/>')
        .attr('src', 'img/udon.png')
        .attr('id', 'udon')
        .appendTo(preloadEl);

    $('body').append(preloadEl);
}

function incrementStaCount() {
    staCount++;
    stepCountObject.setText(staCount.toString());
}

function decrementStaCount() {
    staCount--;
    stepCountObject.setText(staCount.toString());
}

function cWidth(axisW) {
    return (Math.floor(axisW / 2) * 32) + (Math.ceil(axisW / 2) * 4);
}

function cHeight(axisH) {
    return (Math.floor(axisH / 2) * 32) + (Math.ceil(axisH / 2) * 4);
}

function isPlayable() {
    return (state == 1);
}

function roundOver() {

    var roundOverRect = new fabric.Rect({
        left: 0,
        top: 220,
        width: 580,
        height: 130,
        fill: 'black',
        strokeWidth : 0,
        opacity: 0.8
    });

    canvas.add(roundOverRect);
    roundOverRect.bringToFront();

    var roundOverText = new fabric.Text(" クリア！", {
        left: 580,
        top: 250,
        fill: 'yellow',
        fontSize: 60
    });

    roundOverText.animate('left', 150, {
        onChange: canvas.renderAll.bind(canvas),
        duration: 800,
        onComplete: function() {
            canvas.remove(roundOverText);
            canvas.remove(roundOverRect);
        },
        easing: fabric.util.ease.easeOutQuart
    });

    canvas.add(roundOverText);
    roundOverText.bringToFront();
}

function reload() {

    showLoading();

    var requestUri = 'api/v1/user/' + $('#userCode').val() + '/board/' + $('#boardCode').val();

    $.getJSON(requestUri, null, function (data) {
        $('#boardCode').val(data.code);
        history.replaceState(null, null, 'single/' + data.code);
        original = $.extend(true, {}, data);
        maxStep = data.minStep;
        initGame();

        canvas.remove(loadingTextObject);
        canvas.remove(loadingBgObject);

        loadingTextObject = null;
        loadingBgObject = null;

        state = 1;
    });
}

function showLoading() {
    state = 5;

    loadingBgObject = new fabric.Rect({
        left: 0,
        top: 220,
        width: 580,
        height: 130,
        fill: 'black',
        strokeWidth : 0,
        opacity: 0.8
    });

    canvas.add(loadingBgObject);
    loadingBgObject.bringToFront();

    loadingTextObject = new fabric.Text("マップ読込中...", {
        left: 146,
        top: 264,
        width: 580,
        height: 70,
        fill: 'yellow',
        fontSize: 40
    });

    canvas.add(loadingTextObject);
    loadingTextObject.bringToFront();
}