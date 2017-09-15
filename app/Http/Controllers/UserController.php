<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
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
}
