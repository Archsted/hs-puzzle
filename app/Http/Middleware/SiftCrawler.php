<?php

namespace App\Http\Middleware;

use App\User;
use Closure;
use Crawler;

class SiftCrawler
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Crawler::isCrawler()) {
            // true if crawler user agent detected
            abort(403);
        }

        $userCode = $request->cookie('userCode');

        if ($userCode) {
            // 既存プレイヤー
            $user = User::ofCode($userCode)->first();

            // クッキーの情報がDBに無かった場合は新規プレイヤー扱いとする
            if (!$user) {
                $user = $this->createNewUser();
            }
        } else {
            // 新規プレイヤー
            $user = $this->createNewUser();
        }

        $request->setUserResolver(function () use ($user) {
            return $user;
        });

        return $next($request);
    }

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

            if (!User::where('code', $userCode)->first()) {
                break;
            }
        }

        return $userCode;
    }
}
