<?php

namespace App\Http\Controllers;

use App\Board;
use Illuminate\Http\Request;

class SinglePlayController extends Controller
{
    /**
     * @var Board
     */
    protected $board;

    public function __construct(Board $board)
    {
        $this->board = $board;
    }

    public function single(string $code = null)
    {
        return view('single', compact('code'));
    }

    public function board(string $code = null)
    {
        // code指定があればそれを使って取得し、無ければランダムに一つ取得する
        if (is_null($code)) {
            $board = $this->board->inRandomOrder()->limit(1)->firstOrFail();
        } else {
            $board = $this->board->ofCode($code)->limit(1)->firstOrFail();
        }

        $data = [
            'map'   => $board->map->cell_array,
            'code'  => $board->code,
            'stas' => [
                'red' => [
                    'h' => $board->red_y,
                    'w' => $board->red_x,
                ],
                'green' => [
                    'h' => $board->green_y,
                    'w' => $board->green_x,
                ],
                'blue' => [
                    'h' => $board->blue_y,
                    'w' => $board->blue_x,
                ],
                'yellow' => [
                    'h' => $board->yellow_y,
                    'w' => $board->yellow_x,
                ],
            ],
            'udon' => [
                'h' => $board->goalCell->y,
                'w' => $board->goalCell->x,
                'color' => $board->goalCell->color,
            ],
            'minStep'  => $board->step_count,
            'version' => '1',
        ];

        return response()->json($data);
    }
}
