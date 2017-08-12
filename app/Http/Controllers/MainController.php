<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
    const MAP_WIDTH = 32;
    const MAP_HEIGHT = 32;

    const MAP_BLANK = 0;
    const MAP_WALL = 1;
    const MAP_STATURE = 2;

    private $map;

    private $destinations;
    private $destination;

    private $red;
    private $green;
    private $blue;
    private $yellow;

    private $pieceIndex;

    public function createBoard(string $board = null)
    {
        //マップを構成する4つのピース
        $pieces = [
            1 => [
                [1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1],
                [1,0,0,0,0,0,1,0,0,0,0,0,0,0,0,0,0],
                [1,0,0,0,0,0,1,0,0,0,1,0,0,0,0,0,0],
                [1,0,0,0,0,0,0,0,0,0,1,'u1',0,0,0,0,0],
                [1,0,0,0,0,0,0,0,0,0,1,1,1,0,0,0,1],
                [1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,'b',1],
                [1,0,0,0,0,0,0,0,0,0,0,0,0,0,1,1,1],
                [1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],
                [1,1,1,0,0,0,0,0,1,0,0,0,0,0,0,0,0],
                [1,0,0,0,0,0,0,'r1',1,0,0,0,0,0,0,0,0],
                [1,0,0,0,0,0,1,1,1,0,0,0,1,1,1,0,0],
                [1,0,0,0,0,0,0,0,0,0,0,0,1,'g1',0,0,0],
                [1,0,1,1,1,0,0,0,0,0,0,0,1,0,0,0,0],
                [1,0,0,'y1',1,0,0,0,0,0,0,0,0,0,0,0,0],
                [1,0,0,0,1,0,0,0,0,0,0,0,0,0,1,1,1],
                [1,0,0,0,0,0,0,0,0,0,0,0,0,0,1,1,1]
            ],
            2 => [
                [1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1],
                [1,0,0,0,0,0,0,0,0,0,0,0,1,0,0,0,0],
                [1,0,0,0,0,0,0,0,0,0,0,0,1,0,0,0,0],
                [1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],
                [1,0,0,0,0,0,1,1,1,0,0,0,0,0,0,0,0],
                [1,0,0,0,0,0,1,'y2',0,0,0,0,0,0,0,0,0],
                [1,0,0,0,0,0,1,0,0,0,1,0,0,0,0,0,0],
                [1,0,0,0,0,0,0,0,0,0,1,'u2',0,0,0,0,0],
                [1,1,1,0,1,1,1,0,0,0,1,1,1,0,0,0,0],
                [1,0,0,0,0,'r2',1,0,0,0,0,0,0,0,0,0,0],
                [1,0,0,0,0,0,1,0,0,0,1,0,0,0,0,0,0],
                [1,0,0,0,0,0,0,0,0,'g2',1,0,0,0,0,0,0],
                [1,0,0,0,0,0,0,0,1,1,1,0,0,0,0,0,0],
                [1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],
                [1,0,0,0,0,0,0,0,0,0,0,0,0,0,1,1,1],
                [1,0,0,0,0,0,0,0,0,0,0,0,0,0,1,1,1]
            ],
            3 => [
                [1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1],
                [1,0,0,0,1,0,0,0,0,0,0,0,0,0,0,0,0],
                [1,0,0,0,1,0,0,0,1,1,1,0,0,0,0,0,0],
                [1,0,0,0,0,0,0,0,0,'g3',1,0,0,0,0,0,0],
                [1,0,0,0,0,0,0,0,0,0,1,0,0,0,0,0,0],
                [1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],
                [1,0,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0],
                [1,0,1,'r3',0,0,0,0,0,0,0,0,0,0,0,0,0],
                [1,0,1,1,1,0,0,0,0,0,0,0,0,0,0,0,0],
                [1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],
                [1,0,0,0,0,0,0,0,0,0,1,1,1,0,0,0,0],
                [1,0,0,0,0,0,0,0,0,0,1,'y3',0,0,0,0,0],
                [1,1,1,0,0,0,0,0,1,0,1,0,0,0,0,0,0],
                [1,0,0,0,0,0,0,'u3',1,0,0,0,0,0,0,0,0],
                [1,0,0,0,0,0,1,1,1,0,0,0,0,0,1,1,1],
                [1,0,0,0,0,0,0,0,0,0,0,0,0,0,1,1,1]
            ],
            4 => [
                [1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1],
                [1,0,0,0,1,0,0,0,0,0,0,0,0,0,0,0,0],
                [1,0,0,0,1,0,1,1,1,0,0,0,0,0,0,0,0],
                [1,0,0,0,0,0,1,'g4',0,0,0,0,0,0,0,0,0],
                [1,0,0,0,0,0,1,0,0,0,0,0,0,0,0,0,0],
                [1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],
                [1,0,0,0,0,0,0,0,0,0,0,0,0,0,1,0,0],
                [1,0,0,0,0,0,0,0,0,0,0,0,0,'y4',1,0,0],
                [1,0,1,0,0,0,0,0,0,0,0,0,1,1,1,0,0],
                [1,0,1,'r4',0,0,0,0,0,0,0,0,0,0,0,0,0],
                [1,0,1,1,1,0,0,0,0,0,0,0,0,0,0,0,0],
                [1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],
                [1,0,0,0,0,0,0,0,1,1,1,0,0,0,0,0,0],
                [1,0,0,0,0,0,0,0,0,'u4',1,0,0,0,0,0,0],
                [1,1,1,0,0,0,0,0,0,0,1,0,0,0,1,1,1],
                [1,0,0,0,0,0,0,0,0,0,0,0,0,0,1,1,1]
            ]
        ];

        $this->map = $this->getSkeletonMap();

        if (is_null($board)) {
            $pieceIndex = [1, 2, 3, 4];
            shuffle($pieceIndex);
        } else {
            $pieceIndex = preg_split('//', $board, -1, PREG_SPLIT_NO_EMPTY);
            if (
                count(array_unique($pieceIndex)) === 4 &&
                strlen($board) === 4 &&
                min($pieceIndex) == 1 &&
                max($pieceIndex) == 4
            ) {
                // ok

            } else {
                // ng

                $pieceIndex = [1, 2, 3, 4];
                shuffle($pieceIndex);
            }
        }

        $this->pieceIndex = $pieceIndex;

        foreach ($pieceIndex as $index) {
            $this->mergeMap($pieces[$index]);
            $this->rotate();
        }

        // ゴールの場所を抽出
        $this->initDestinations();

    }


    public function board(Request $request)
    {
        $this->createBoard($request->get('b'));

        $this->initStaturePosition();

        $data = [
            'map'   => $this->map,
            'stas' => [
                'red' => [
                    'h' => $this->red['h'],
                    'w' => $this->red['w'],
                ],
                'green' => [
                    'h' => $this->green['h'],
                    'w' => $this->green['w'],
                ],
                'blue' => [
                    'h' => $this->blue['h'],
                    'w' => $this->blue['w'],
                ],
                'yellow' => [
                    'h' => $this->yellow['h'],
                    'w' => $this->yellow['w'],
                ],
            ],
            'udon' => [
                'h' => $this->destination['h'],
                'w' => $this->destination['w'],
                'color' => $this->destination['c'],
            ],
            'minStep'  => $this->getMinStep(),
        ];

        return response()->json($data);
    }

    protected function initDestination()
    {
        $destinationKeys = [
            'r1', 'r2', 'r3', 'r4',
            'g1', 'g2', 'g3', 'g4',
            'u1', 'u2', 'u3', 'u4',
            'y1', 'y2', 'y3', 'y4',
            'b',
        ];

        shuffle($destinationKeys);

        $destination = $this->destinations[head($destinationKeys)];

        $this->destination = $destination;
    }


    protected function getMinStep()
    {
        $command = sprintf('%s %s %s %d %d %s %d %d %d %d %d %d %d %d',
            '/home/2ndregion/bin/rbenv/versions/2.4.1/bin/ruby',
            resource_path('hs_resolver.rb'),
            implode(',', $this->pieceIndex),
            $this->destination['h'],
            $this->destination['w'],
            $this->destination['c'],
            $this->red['h'],
            $this->red['w'],
            $this->green['h'],
            $this->green['w'],
            $this->blue['h'],
            $this->blue['w'],
            $this->yellow['h'],
            $this->yellow['w']
        );

        $output = [];
        $return = 0;

        exec($command, $output, $return);

        $minStep = $output[0];

        if (!ctype_digit($minStep)) {
            exit();
        }

        return intval($minStep);
    }


    protected function getSkeletonMap() {
        $skeleton = [];

        //31x31の、初期値に1をセットした配列を作成する
        for ($h = 0; $h <= self::MAP_HEIGHT; $h++) {
            $row = [];

            for ($w = 0; $w <= self::MAP_WIDTH; $w++) {
                $row[] = 1;
            }

            $skeleton[] = $row;
        }

        return $skeleton;
    }


    //引数に指定したマップ（切れ端）を、全体マップの左上部分に埋め込む
    protected function mergeMap($piece) {
        for ($h = 0; $h < count($piece); $h++) {
            for ($w = 0; $w < count($piece[$h]); $w++) {
                $this->map[$h][$w] = $piece[$h][$w];
            }
        }
    }

    //全体マップを反時計回りに90度回転させる
    protected function rotate() {
        $skeleton = $this->getSkeletonMap();

        for ($h = 0; $h <= self::MAP_HEIGHT; $h++) {
            for ($w = 0; $w <= self::MAP_WIDTH; $w++) {
                $skeleton[self::MAP_HEIGHT - $w][$h] = $this->map[$h][$w];
            }
        }

        $this->map = $skeleton;
    }

    private function initDestinations() {
        $this->destinatios = [];

        $colorMap = [
            'r' => 'red',
            'g' => 'green',
            'u' => 'blue',
            'y' => 'yellow',
            'b' => 'black',
        ];

        for ($h = 0; $h <= self::MAP_HEIGHT; $h++) {
            for ($w = 0; $w <= self::MAP_WIDTH; $w++) {
                if (!($this->map[$h][$w] === self::MAP_BLANK || $this->map[$h][$w] === self::MAP_WALL)) {
                    $color = ($this->map[$h][$w])[0];

                    // ゴールの場所を保持
                    $this->destinations[$this->map[$h][$w]] = [
                        'h' => $h,
                        'w' => $w,
                        'c' => $colorMap[$color],
                    ];

                    // マーカーを通常床に変更
                    $this->map[$h][$w] = self::MAP_BLANK;
                }
            }
        }

        ksort($this->destinations);

        $this->initDestination();
    }

    private function initStaturePosition($defaults = null)
    {
        $this->red = null;
        $this->green = null;
        $this->blue = null;
        $this->yellow = null;

        while (is_null($this->red)) {
            $h = $this->getRandomStaturePosition();
            $w = $this->getRandomStaturePosition();

            if ($this->isBlankCell($h, $w)) {
                $this->red = ['h' => $h, 'w' => $w];
                $this->map[$h][$w] = self::MAP_STATURE;
            }
        }

        while (is_null($this->green)) {
            $h = $this->getRandomStaturePosition();
            $w = $this->getRandomStaturePosition();

            if ($this->isBlankCell($h, $w)) {
                $this->green = ['h' => $h, 'w' => $w];
                $this->map[$h][$w] = self::MAP_STATURE;
            }
        }

        while (is_null($this->blue)) {
            $h = $this->getRandomStaturePosition();
            $w = $this->getRandomStaturePosition();

            if ($this->isBlankCell($h, $w)) {
                $this->blue = ['h' => $h, 'w' => $w];
                $this->map[$h][$w] = self::MAP_STATURE;
            }
        }

        while (is_null($this->yellow)) {
            $h = $this->getRandomStaturePosition();
            $w = $this->getRandomStaturePosition();

            if ($this->isBlankCell($h, $w)) {
                $this->yellow = ['h' => $h, 'w' => $w];
                $this->map[$h][$w] = self::MAP_STATURE;
            }
        }
    }

    private function isBlankCell($h, $w)
    {
        return ($this->map[$h][$w] === self::MAP_BLANK);
    }


    private function getRandomStaturePosition() {
        $values = range(1, 31, 2);
        return $values[mt_rand(0, count($values) - 1)];
    }

    public function dump($map) {
        foreach ($map as $hk => $h) {
            foreach ($h as $wk => $w) {
                switch ($w) {
                    case self::MAP_BLANK:
                        echo '□';
                        break;
                    case self::MAP_WALL:
                        echo '■';
                        break;
                    case self::MAP_STATURE:
                        if ($this->red['h'] === $hk && $this->red['w'] === $wk) {
                            echo 'Ｒ';
                        } elseif ($this->green['h'] === $hk && $this->green['w'] === $wk) {
                            echo 'Ｇ';
                        } elseif ($this->blue['h'] === $hk && $this->blue['w'] === $wk) {
                            echo 'Ｂ';
                        } elseif ($this->yellow['h'] === $hk && $this->yellow['w'] === $wk) {
                            echo 'Ｙ';
                        }
                        break;
                    default:
                        echo '？';
                        break;
                }
            }
            echo PHP_EOL;
        }

        print_r($this->destinations);
    }


}
