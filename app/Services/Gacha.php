<?php

namespace App\Services;

use App\Stamp;
use App\User;

class Gacha
{
    public function getStampByStep(User $user, $step)
    {
        $weights = [1 => 100, 2 => 0, 3 => 0, 4 => 0, 5 => 0];

        switch ($step) {
            case 0:
                $weights = [1 => 100, 2 => 0, 3 => 0, 4 => 0, 5 => 0];
                break;
            case 1:
                $weights = [1 => 80, 2 => 18, 3 => 2, 4 => 0, 5 => 0];
                break;
            case 2:
                $weights = [1 => 70, 2 => 24, 3 => 6, 4 => 0, 5 => 0];
                break;
            case 3:
                $weights = [1 => 60, 2 => 30, 3 => 10, 4 => 0, 5 => 0];
                break;
            case 4:
                $weights = [1 => 50, 2 => 40, 3 => 10, 4 => 0, 5 => 0];
                break;
            // 中級
            case 5:
                $weights = [1 => 20, 2 => 38, 3 => 32, 4 => 9, 5 => 1];
                break;
            case 6:
                $weights = [1 => 15, 2 => 35, 3 => 36, 4 => 12, 5 => 2];
                break;
            case 7:
                $weights = [1 => 10, 2 => 32, 3 => 40, 4 => 15, 5 => 3];
                break;
            // 上級
            case 8:
                $weights = [1 => 0, 2 => 0, 3 => 76, 4 => 20, 5 => 4];
                break;
            case 9:
                $weights = [1 => 0, 2 => 0, 3 => 64, 4 => 28, 5 => 8];
                break;
            case 10:
                $weights = [1 => 0, 2 => 0, 3 => 52, 4 => 36, 5 => 12];
                break;
            case 11:
                $weights = [1 => 0, 2 => 0, 3 => 40, 4 => 44, 5 => 16];
                break;
            case 12:
                $weights = [1 => 0, 2 => 0, 3 => 28, 4 => 42, 5 => 30];
                break;
            default:
                // 13以上
                $weights = [1 => 0, 2 => 0, 3 => 0, 4 => 35, 5 => 50];
        }

        // レアリティをランダムに求める（1-5）
        $rarity = $this->raffle($weights);

        // 求めたレアリティのスタンプをランダムに1つ取得する
        $stamp = Stamp::ofRarity($rarity)->inRandomOrder()->first();

        // 取得スタンプに結びつける
        $user->stamps()->attach($stamp->id);

        return $stamp;
    }

    private function raffle($weights)
    {
        $val = mt_rand(0, array_sum($weights));
        $tmp = 0;
        foreach($weights as $rarity => $v){
            $tmp += $v;
            if ($val <= $tmp) {
                return $rarity;
            }
        }
        return 1;
    }
}