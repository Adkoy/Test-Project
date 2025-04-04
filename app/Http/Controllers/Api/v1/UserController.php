<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * @OA\Info(
     *     title="Test Project",
     *     version="1.0.0",
     *     description="This is the API documentation for HomayTech test project."
     * )
     * @OA\Get(
     *     path="/api/users",
     *     summary="Get all users",
     *     operationId="getUsers",
     *     tags={"Users"},
     *     @OA\Parameter(
     *         name="user_uuid",
     *         in="query",
     *         required=false,
     *         description="Filter by user UUID",
     *         @OA\Schema(type="string", format="uuid")
     *     ),
     *        @OA\Parameter(
     *         name="email",
     *         in="query",
     *         required=false,
     *         description="Filter by user email",
     *         @OA\Schema(type="string", format="email")
     *     ),
     *     @OA\Parameter(
     *         name="card_number",
     *         in="query",
     *         required=false,
     *         description="Filter by card number",
     *         @OA\Schema(type="string", maxLength=15)
     *     ),
     *     @OA\Parameter(
     *         name="level",
     *         in="query",
     *         required=false,
     *         description="Filter by user level",
     *         @OA\Schema(type="integer", enum={1,2,3,4})
     *     ),
     *     @OA\Parameter(
     *         name="card_number_count",
     *         in="query",
     *         required=false,
     *         description="Filter by number of bank cards",
     *         @OA\Schema(type="integer", minimum=0)
     *     ),  @OA\Response(
     *         response=200,
     *         description="A list of users",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 @OA\Property(property="user_uuid", type="string", format="uuid"),
     *                 @OA\Property(property="email", type="string", format="email"),
     *                 @OA\Property(property="bank_cards", type="array", items=@OA\Items(type="string")),
     *                 @OA\Property(property="level", type="integer")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid parameters"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="User not found"
     *     )
     * )
     */

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
