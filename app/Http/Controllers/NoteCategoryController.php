<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNoteCategoryRequest;
use App\Services\NoteCategoryService;


class NoteCategoryController extends Controller
{
    public function __construct(
        private NoteCategoryService $noteCategoryService
    ){}

    /**
     * Store a newly created resource in storage.
     */
    public function store(int $noteId, StoreNoteCategoryRequest $request)
    {
        $this->noteCategoryService->attachCategoryToNote($noteId, $request);

        return response()->json([
            'message' => 'categoria agregada a la nota correctamente'
        ], 201);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $noteId, int $categoryId)
    {
        $this->noteCategoryService->detachCategoryFromNote($noteId, $categoryId);

        return response()->noContent();
    }
}
