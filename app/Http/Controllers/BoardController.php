<?php

namespace App\Http\Controllers;

use App\Board;
use App\Cell;
use App\History;
use App\Services\Gacha;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BoardController extends Controller
{
    protected $gacha;

    public function __construct(Gacha $gacha)
    {
        $this->gacha = $gacha;
    }

    public function answer(Request $request, string $userCode, string $boardCode)
    {
        $user = User::ofCode($userCode)->firstOrFail();
        $board = Board::ofCode($boardCode)->firstOrFail();

        $answers = $request->answers;

        $map = $board->map->cellArray;

        $map[$board->red_y][$board->red_x] = Cell::TYPE_STACHOO;
        $map[$board->green_y][$board->green_x] = Cell::TYPE_STACHOO;
        $map[$board->blue_y][$board->blue_x] = Cell::TYPE_STACHOO;
        $map[$board->yellow_y][$board->yellow_x] = Cell::TYPE_STACHOO;

        $lastAnswer = null;
        foreach ($answers as $answer) {
            $map[$board->{$answer['color'] . '_y'}][$board->{$answer['color'] . '_x'}] = Cell::TYPE_BLANK;

            switch ($answer['direction']) {
                case 1:
                    while (true) {
                        if ($map[$board->{$answer['color'] . '_y'} - 1][$board->{$answer['color'] . '_x'}] === Cell::TYPE_WALL ||
                            $map[$board->{$answer['color'] . '_y'} - 2][$board->{$answer['color'] . '_x'}] === Cell::TYPE_STACHOO) {
                            break;
                        }
                        $board->{$answer['color'] . '_y'} = $board->{$answer['color'] . '_y'} - 2;
                    }
                    break;
                case 2:
                    while (true) {
                        if ($map[$board->{$answer['color'] . '_y'}][$board->{$answer['color'] . '_x'} + 1] === Cell::TYPE_WALL ||
                            $map[$board->{$answer['color'] . '_y'}][$board->{$answer['color'] . '_x'} + 2] === Cell::TYPE_STACHOO) {
                            break;
                        }
                        $board->{$answer['color'] . '_x'} = $board->{$answer['color'] . '_x'} + 2;
                    }
                    break;
                case 3:
                    while (true) {
                        if ($map[$board->{$answer['color'] . '_y'} + 1][$board->{$answer['color'] . '_x'}] === Cell::TYPE_WALL ||
                            $map[$board->{$answer['color'] . '_y'} + 2][$board->{$answer['color'] . '_x'}] === Cell::TYPE_STACHOO) {
                            break;
                        }
                        $board->{$answer['color'] . '_y'} = $board->{$answer['color'] . '_y'} + 2;
                    }
                    break;
                case 4:
                    while (true) {
                        if ($map[$board->{$answer['color'] . '_y'}][$board->{$answer['color'] . '_x'} - 1] === Cell::TYPE_WALL ||
                            $map[$board->{$answer['color'] . '_y'}][$board->{$answer['color'] . '_x'} - 2] === Cell::TYPE_STACHOO) {
                            break;
                        }
                        $board->{$answer['color'] . '_x'} = $board->{$answer['color'] . '_x'} - 2;
                    }
                    break;
            }
            $map[$board->{$answer['color'] . '_y'}][$board->{$answer['color'] . '_x'}] = Cell::TYPE_STACHOO;

            $lastAnswer = $answer;
        }

        if ($board->goalCell->y === $board->{$lastAnswer['color'] . '_y'} &&
            $board->goalCell->x === $board->{$lastAnswer['color'] . '_x'} &&
            $board->goalCell->color === $lastAnswer['color'] &&
            $board->step_count <= count($answers)) {

            $isFirstClear = false;

            // クリア履歴をつける
            $history = History::query()->where('user_id', $user->id)->where('board_id', $board->id)->first();
            if ($history) {
                // 未クリアだった時のみ、初回クリアの日時を入れる
                if (!$history->cleared_at) {
                    $history->cleared_at = Carbon::now();
                    $isFirstClear = true;
                }
                $history->save();
            }

            // 未クリアだった時
            if ($isFirstClear) {
                // 所持スタンプを取得しておく
                $stampIds = $user->stamps->pluck('id')->toArray();

                // スタンプガチャ
                $newStamp = $this->gacha->getStampByStep($user, $board->step_count);

                // Newスタンプかどうか
                $haveStamp = in_array($newStamp->id, $stampIds);

                return response(['status' => 'ok', 'stamp' => $newStamp, 'isNewStamp' => ($haveStamp) ? 0 : 1]);
            } else {
                return response(['status' => 'ok']);
            }

        } else {
            return response(['status' => 'ng', 'message' => '不正な回答を検知しました。']);
        }
    }

}
