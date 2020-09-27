<?php

namespace App\Http\Controllers;

use App\Events\UserCreated;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Models\User;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * Returns all users.
     *
     * @OA\Get(
     *     path="/users",
     *     tags={"User"},
     *     operationId="getUsers",
     *     summary="Получение пользователей.",
     *     @OA\Response(
     *          response=200,
     *          description="Success response"
     *      ),
     * )
     *
     * @return UserCollection
     */
    public function index(): UserCollection
    {
        return new UserCollection(User::get());
    }


    /**
     * Save user to db
     *
     * @OA\Post(
     *     path="/users",
     *     tags={"User"},
     *     operationId="storeUser",
     *     summary="Создает пользователя",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     description="ФИО пользователя",
     *                     property="name",
     *                     type="string",
     *                     example="Лебовский Василий Пупкин",
     *                 ),
     *                 @OA\Property(
     *                     description="Email пользователя",
     *                     property="email",
     *                     type="string",
     *                     example="lebovskiy@gmail.com",
     *                 ),
     *                 @OA\Property(
     *                     description="Признак администратора",
     *                     property="is_admin",
     *                     type="boolean",
     *                     example=true,
     *                 ),
     *                 required={"name", "email", "is_admin"},
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *          response=200,
     *          description="Success response"
     *      ),
     *     @OA\Response(
     *          response=201,
     *          description="Success creation"
     *      ),
     * )
     * @param StoreUserRequest $request
     *
     * @return UserResource
     */
    public function store(StoreUserRequest $request): UserResource
    {
        $email = $request->email;
        $name = $request->name;
        $isAdmin = $request->is_admin;

        $password = Str::random(8);
        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
            'is_admin' => $isAdmin,
        ]);

        event(new UserCreated($user, $password));

        return (new UserResource($user))->additional(['status' => 'success']);
    }


    /**
     * Update user
     *
     * @OA\Put(
     *     path="/users/{id}",
     *     tags={"User"},
     *     operationId="updateUser",
     *     summary="Обновляет информацию о пользователе.",
     *     @OA\Parameter(
     *         description="Id обновляемого пользователя",
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(
     *           type="integer",
     *         ),
     *     ),
     *     @OA\RequestBody(
     *         description="Формат входящих данных",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 type="object",
     *                 @OA\Property(
     *                     description="ФИО пользователя.",
     *                     property="name",
     *                     type="string",
     *                     example="Лебовский Василий Пупкин",
     *                 ),
     *                 @OA\Property(
     *                     description="Email пользователя.",
     *                     property="email",
     *                     type="string",
     *                     example="lebovskiy@gmail.com",
     *                 ),
     *                 @OA\Property(
     *                     description="Признак администратора.",
     *                     property="is_admin",
     *                     type="boolean",
     *                     example=true,
     *                 ),
     *             ),
     *         ),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Success response"
     *     ),
     * )
     *
     * @param int $id
     * @param UpdateUserRequest $request
     *
     * @return Application|ResponseFactory|JsonResponse|Response
     */
    public function update($id, UpdateUserRequest $request)
    {
        $email = $request->email;
        $name = $request->name;
        $isAdmin = $request->is_admin;

        /** @var User $user */
        $user = User::find($id);
        $user->email = $email;
        $user->name = $name;
        $user->is_admin = $isAdmin;

        if (!$user->save()) {
            return response()->json(['status' => 'error', 'errors' => [
                'message' => 'Ошибка сохранения произведения',
            ]]);
        }

        return response('', 200);
    }


    /**
     * Delete user
     *
     * @OA\Delete(
     *     path="/users/{id}",
     *     tags={"User"},
     *     operationId="deleteUser",
     *     summary="Удалить пользователя.",
     *     @OA\Parameter(
     *         description="Id удаляемого пользователя.",
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(
     *           type="integer",
     *         ),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Success response"
     *     ),
     * )
     *
     * @param $id
     *
     * @return Application|ResponseFactory|JsonResponse|Response
     */
    public function delete($id) {
        $userId = (int)$id;

        /** @var User $user */
        $user = User::find($userId);

        try {
            $user->delete();
        } catch (Exception $e) {
            return response()->json(['status' => 'error', 'errors' => [
                'message' => 'Ошибка удаления пользователя.',
            ]]);
        }

        return response('', 200);
    }
}
