<?php

namespace App\Http\Controllers;

use App\Http\Requests\Composer\StoreComposerRequest;
use App\Http\Requests\Composer\UpdateComposerRequest;
use App\Http\Resources\ComposerCollection;
use App\Http\Resources\ComposerResource;
use App\Models\Composer;
use Exception;
use Illuminate\Http\JsonResponse;

class ComposerController extends Controller
{

    /**
     * Returns all composers.
     *
     * @OA\Get(
     *     path="/composers",
     *     tags={"Composer"},
     *     operationId="getComposers",
     *     summary="Получение композиторов.",
     *     @OA\Response(
     *          response=200,
     *          description="Success response"
     *      ),
     * )
     *
     * @return ComposerCollection
     */
    public function index(): ComposerCollection
    {
        return new ComposerCollection(Composer::get());
    }


    /**
     * Save composer to db
     *
     * @OA\Post(
     *     path="/composers",
     *     tags={"Composer"},
     *     operationId="storeComposer",
     *     summary="Создает композитора.",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     description="Название произведения",
     *                     property="composerName",
     *                     type="string",
     *                     example="Бетховен",
     *                 ),
     *                 required={"composerName"},
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
     * @param StoreComposerRequest $request
     *
     * @return ComposerResource
     */
    public function store(StoreComposerRequest $request): ComposerResource
    {
        $composer = Composer::create([
            'composer_name' => $request->composerName,
        ]);

        return (new ComposerResource($composer))
            ->additional(['status' => 'success']);
    }

    /**
     * Update composer
     *
     * @OA\Put(
     *     path="/composers/{id}",
     *     tags={"Composer"},
     *     operationId="updateComposer",
     *     summary="Обновляет информацию о композиторе.",
     *     @OA\Parameter(
     *         description="Id обновляемого композитора",
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
     *                     description="Название произведения",
     *                     property="composerName",
     *                     type="string",
     *                     example="Adazio",
     *                 ),
     *                 @OA\Property(
     *                     description="Id композитора произведения",
     *                     property="composerId",
     *                     type="integer",
     *                     example=12,
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
     * @param $id
     * @param UpdateComposerRequest $request
     *
     * @return ComposerResource
     */
    public function update($id, UpdateComposerRequest $request): ComposerResource
    {
        $composerId = (int)$id;

        $composer = Composer::find($composerId);
        $composer->composer_name = $request->composerName;
        $composer->save();

        return (new ComposerResource($composer))
            ->additional(['status' => 'success']);
    }

    /**
     * Delete composer
     *
     * @OA\Delete(
     *     path="/composers/{id}",
     *     tags={"Composer"},
     *     operationId="deleteComposer",
     *     summary="Удалить композитора.",
     *     @OA\Parameter(
     *         description="Id удаляемого композитора.",
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
     * @return JsonResponse
     */
    public function delete($id): JsonResponse
    {
        $composerId = (int)$id;

        /** @var Composer $composer */
        $composer = Composer::find($composerId);
        try {
            $composer->delete();
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'errors' => [
                    'message' => 'Ошибка удаления композитора.'
                ]
            ]);
        }

        return response()->json(['status' => 'success']);
    }
}
