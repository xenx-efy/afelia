<?php

namespace App\Http\Controllers;

use App\Http\Requests\Composer\DeleteComposerRequest;
use App\Http\Requests\Composer\StoreComposerRequest;
use App\Http\Requests\Composer\UpdateComposerRequest;
use App\Http\Resources\ComposerCollection;
use App\Http\Resources\ComposerResource;
use App\Models\Composer;

class ComposerController extends Controller
{
    public function index()
    {
        return new ComposerCollection(Composer::get());
    }

    public function store(StoreComposerRequest $request)
    {
        $composer = Composer::create([
            'composer_name' => $request->composerName,
        ]);

        return (new ComposerResource($composer))
            ->additional(['status' => 'success']);
    }

    public function update(UpdateComposerRequest $request)
    {
        $composer = Composer::find($request->composerId);
        $composer->composer_name = $request->composerName;
        $composer->save();

        return (new ComposerResource($composer))
            ->additional(['status' => 'success']);
    }

    public function delete(DeleteComposerRequest $request)
    {
        /** @var Composer $composer */
        $composer = Composer::find($request->composerId);
        try {
            $composer->delete();
        } catch (\Exception $e) {
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
