<?php

namespace App\Services;

use App\Http\Requests\StoreNoteCategoryRequest;
use App\Models\Note;

class NoteCategoryService 
{
    public function attachCategoryToNote(int $noteId, StoreNoteCategoryRequest $request)
    {
        $note = Note::findOrFail($noteId);

        $note->categories()->syncWithoutDetaching($request->input('category_id'));
    }

    public function detachCategoryFromNote(int $noteId, int $categoryId)  
    {
        $note = Note::findOrFail($noteId);

        $note->categories()->detach($categoryId);
    }
}