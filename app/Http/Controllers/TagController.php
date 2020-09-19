<?php

namespace App\Http\Controllers;

use App\Http\Requests\Tag\DeleteTagRequest;
use App\Http\Requests\Tag\StoreTagRequest;
use App\Http\Requests\Tag\UpdateTagRequest;
use App\Http\Resources\TagCollection;
use App\Http\Resources\TagResource;
use App\Models\Tag;

class TagController extends Controller
{

    public function index()
    {
        return new TagCollection(Tag::get());
    }

    public function store(StoreTagRequest $request)
    {
        $tag = Tag::create([
            'title' => $request->title
        ]);

        return (new TagResource($tag))->additional(['status' => 'success']);
    }

    public function update(UpdateTagRequest $request)
    {
        $tag = Tag::find($request->tagId);

        $tag->title = $request->title;

        $tag->save();

        return response(['status' => 'success'], 200);
    }

    public function delete(DeleteTagRequest $request)
    {
        /** @var Tag $tag */
        $tag = Tag::find($request->tagId);
        try {
            $tag->delete();
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'errors' => [
                'message' => 'Ошибка удаления тега.',
            ]]);
        }

        return response(['status' => 'success'], 200);
    }
}
