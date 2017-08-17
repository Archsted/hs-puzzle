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
        $userCode = $request->cookie('userCode');

        if ($userCode) {
            // 既存プレイヤー
            $user = $this->user->ofCode($userCode)->first();

            // クッキーの情報がDBに無かった場合は新規プレイヤー扱いとする
            if (!$user) {
                $user = $this->createNewUser();
            }
        } else {
            // 新規プレイヤー
            $user = $this->createNewUser();
       }

       $userCode = $user->code;

        return response()
            ->view('single', compact('boardCode', 'userCode'))
            ->cookie('userCode', $user->code);
    }

    public function board(string $userCode, string $boardCode = null)
    {
        // boardCode指定があればそれを使って取得し、無ければランダムに一つ取得する
        if (is_null($boardCode)) {
            $board = $this->board->inRandomOrder()->limit(1)->firstOrFail();
        } else {
            $board = $this->board->ofCode($boardCode)->limit(1)->firstOrFail();
        }

        $user = $this->user->ofCode($userCode)->firstOrFail();

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
            'version' => '1',
        ];

        return response()->json($data);
    }

    /**
     * Userを新規作成し、作成したUserモデルを返す
     *
     * @return User
     */
    private function createNewUser()
    {
        $userCode = $this->getRandomUserCode();

        return $this->user->create([
            'code' => $userCode,
        ]);
    }

    /**
     * Userのcode用ランダム文字列を生成して返す
     *
     * @return string
     */
    private function getRandomUserCode()
    {
        $userCode = '';

        // 重複しないコードをランダム生成
        while (true) {
            $userCode = hash('sha256', str_random(16));

            if (!$this->user->where('code', $userCode)->first()) {
                break;
            }
        }

        return $userCode;
    }
}
