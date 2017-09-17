<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class RankingController extends Controller
{
    public function index()
    {
        $users = User::query()
            ->with(['histories' => function ($query) {
                $query->whereNotNull('cleared_at');
            }, 'stamps' => function ($query) {
                $query->select('id');
            }])
            ->get();

        $stampCountList = [];
        $historyCountList = [];
        $userNames = [];
        foreach ($users as $user) {
            $userNames[$user->id] = $user->name;
            $stampCountList[$user->id] = $user->stamps->unique('id')->count();
            $historyCountList[$user->id] = $user->histories->count();
        }

        // スタンプ数で逆順ソート
        arsort($stampCountList);

        // クリア数で逆順ソート
        arsort($historyCountList);

        $stampUsers = [];
        $lastCount = 999;
        foreach ($stampCountList as $userId => $stampCount) {
            if (count($stampUsers) >= 10 && $stampCount != $lastCount) {
                break;
            }

            $stampUsers[] = [
                'name' => $userNames[$userId],
                'count' => $stampCount,
            ];

            $lastCount = $stampCount;
        }


        $historyUsers = [];
        $lastCount = 999;
        foreach ($historyCountList as $userId => $historyCount) {
            if (count($historyUsers) >= 10 && $historyCount != $lastCount) {
                break;
            }

            $historyUsers[] = [
                'name' => $userNames[$userId],
                'count' => $historyCount,
            ];

            $lastCount = $historyCount;
        }

        return view('ranking', compact('stampUsers', 'historyUsers'));
    }
}
