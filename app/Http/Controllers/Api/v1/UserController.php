<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(UserRequest $request)
    {
        $request->validated();
        $users = User::query()->withCount('bank_cards');

        if ($request->filled('user_uuid')) {
            $users->where('user_uuid', $request->get('user_uuid'));
        }

        if ($request->filled('email')) {
            $users->where('email', $request->get('email'));
        }

        if ($request->filled('card_number')) {
            $users->wherehas('bank_cards', function ($query) use ($request) {
                $query->where('card_number', $request->get('card_number'));
            });
        }

        if ($request->filled('level')) {
            $users->wherehas('level', function ($query) use ($request) {
                $query->where('level', $request->get('level'));
            });
        }

        if ($request->filled('card_number_count')) {
            $users->having('bank_cards_count', $request->get('card_number_count'));
        }

        return response([
            'result' => UserResource::collection($users->get()),
            'status' => true,
        ], 200);

    }
}
