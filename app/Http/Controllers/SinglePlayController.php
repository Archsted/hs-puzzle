<?php

namespace App\Http\Controllers;

use App\Board;
use App\History;
use App\User;
use Illuminate\Http\Request;

class SinglePlayController extends Controller
{
    /**
     * @var Board
     */
    protected $board;

    /**
     * @var History
     */
    protected $history;

    /**
     * @var User
     */
    protected $user;

    public function __construct(Board $board, User $user, History $history)
    {
        $this->board = $board;
        $this->history = $history;
        $this->user = $user;
    }

    public function single(Request $request, string $boardCode = null)
    {
        return response()
            ->view('single', compact('boardCode', 'userCode'))
            ->cookie('userCode', $request->user()->code);
    }

    public function board(string $userCode, string $boardCode = null)
    {
        $user = $this->user->ofCode($userCode)->firstOrFail();

        // boardCode指定があればそれを使って取得し、無ければランダムに一つ取得する
        if (is_null($boardCode)) {
            $board = $this->board->notReserved()->inRandomOrder()->limit(1)->firstOrFail();
        } else {
            $board = $this->board->ofCode($boardCode)->limit(1)->firstOrFail();
        }

        // 履歴を作成する前に、履歴を全て取得しておく
        $histories = $board->histories;

        // 履歴作成もしくは日時更新
        $this->history
            ->where('user_id', $user->id)
            ->where('board_id', $board->id)
            ->firstOrCreate([
                'user_id' => $user->id,
                'board_id' => $board->id,
            ])
            ->touch();

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
            'totalUser' => $histories->count(),
            'clearUser' => $histories->filter(function ($value, $key) {
                return !is_null($value->cleared_at);
            })->count(),
            'version' => '1',
        ];

        return response()->json($data);
    }

}
