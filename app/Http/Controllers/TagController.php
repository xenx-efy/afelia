<?php

namespace App\Http\Controllers;

use App\Http\Requests\Tag\StoreTagRequest;
use App\Http\Requests\Tag\UpdateTagRequest;
use App\Http\Resources\TagCollection;
use App\Http\Resources\TagResource;
use App\Models\Tag;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class TagController extends Controller
{
    /**
     * Returns all tags.
     *
     * @OA\Get(
     *     path="/tags",
     *     tags={"Tag"},
     *     operationId="getTags",
     *     summary="Получение тегов.",
     *     @OA\Response(
     *          response=200,
     *          description="Success response"
     *      ),
     * )
     *
     * @return TagCollection
     */
    public function index(): TagCollection
    {
        return new TagCollection(Tag::get());
    }


    /**
     * Save tag to db
     *
     * @OA\Post(
     *     path="/tags",
     *     tags={"Tag"},
     *     operationId="storeTag",
     *     summary="Создает тег.",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     description="Нвазния тегов",
     *                     property="titles",
     *                     type="array",
     *                     example="Smooth",
     *                     @OA\Items(type="string"),
     *                 ),
     *                 required={"title"},
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
     * @param StoreTagRequest $request
     *
     * @return TagCollection
     */
    public function store(StoreTagRequest $request): TagCollection
    {
        $tags = [];
        foreach ($request->titles as $title) {
            $tags[] = Tag::create([
                'title' => $title
            ]);
        }

        return new TagCollection($tags);
    }


    /**
     * Update tag
     *
     * @OA\Put(
     *     path="/tags/{id}",
     *     tags={"Tag"},
     *     operationId="updateTag",
     *     summary="Обновляет информацию о теге.",
     *     @OA\Parameter(
     *         description="Id обновляемого тега",
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
     *                     description="Название тега",
     *                     property="title",
     *                     type="string",
     *                     example="Adazio",
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
     * @param UpdateTagRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTagRequest $request): Response
    {
        $tagId = (int)$id;

        $tag = Tag::find($tagId);

        $tag->title = $request->title;

        $tag->save();

        return response(['status' => 'success'], 200);
    }


    /**
     * Delete tag
     *
     * @OA\Delete(
     *     path="/tags/{id}",
     *     tags={"Tag"},
     *     operationId="deleteTag",
     *     summary="Удалить тег.",
     *     @OA\Parameter(
     *         description="Id удаляемого тега.",
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
        $tagId = (int)$id;

        /** @var Tag $tag */
        $tag = Tag::find($tagId);
        try {
            $tag->delete();
        } catch (Exception $exception) {
            return response()->json(['status' => 'error', 'errors' => [
                'message' => 'Ошибка удаления тега.'
            ]]);
        }

        return response()->json(['status' => 'success']);
    }
}
