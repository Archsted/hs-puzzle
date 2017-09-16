<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Stamp;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function update(UpdateUserRequest $request, string $userCode)
    {
        $user = User::ofCode($userCode)->firstOrFail();

        $user->name = $request->get('name');
        $user->save();

        $result = [
            'name'  => $user->name,
        ];

        return response()->json($result);
    }

    public function stamps()
    {
        $allStamps = Stamp::query()->orderBy('id')->get();

        $myStamps = request()->user()->stamps->pluck('id')->unique()->values()->toArray();

        $stamps = [
            5 => [],
            4 => [],
            3 => [],
            2 => [],
            1 => [],
        ];

        foreach ($allStamps as $stamp) {
            if (in_array($stamp->id, $myStamps)) {
                $stamps[$stamp->rarity][] = $stamp->code;
            } else {
                $stamps[$stamp->rarity][] = 'unknown';
            }
        }

        return view('stamps', compact('stamps'));
    }
}
