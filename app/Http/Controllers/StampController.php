<?php

namespace App\Http\Controllers;

use App\Stamp;
use Illuminate\Http\Request;

class StampController extends Controller
{
    /**
     * @var Stamp $stamp
     */
    protected $stamp;

    public function __construct(Stamp $stamp)
    {
        $this->stamp = $stamp;
    }

    public function showImage(Request $request, $stampCode)
    {
        if ($stampCode == 'unknown') {
            return response()->file(resource_path('img/stamp/unknown.png'));
        }

        $stamp = $this->stamp->ofCode($stampCode)->first();

        if (is_null($stamp)) {
            // 無効なスタンプが指定されてきた場合
            $path = resource_path('img/stamp/blank.png');
        } else {
            $user = $request->user();

            // 所持スタンプ
            $stampIds = $user->stamps()->groupBy('id')->pluck('id')->toArray();

            if (!in_array($stamp->id, $stampIds)) {
                // スタンプを持っていない時
                $path = resource_path('img/stamp/unknown.png');
            } else {
                // 正常なスタンプ
                $path = resource_path('img/stamp/' . $stamp->image);
            }
        }

        return response()->file($path);
    }
}
