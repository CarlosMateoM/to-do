<?php

namespace App\Services;

use App\Http\Requests\StoreNoteRequest;
use App\Http\Requests\UpdateNoteRequest;
use App\Models\Note;
use Illuminate\Http\Request;

class NoteService
{
    public function getNotes(Request $request)
    {
        return Note::with(['user', 'categories'])
            ->when($request->has('sort'), function ($query) use ($request) {
                $sorts = explode(',', $request->query('sort'));
                foreach($sorts as $sort) 
                {
                    $direction = 'asc';
                    if(strpos($sort, '-') === 0)
                    {
                        $direction = 'desc';
                        $sort = substr($sort, 1);
                    }
                    $query->orderBy($sort, $direction);
                }
            })
            ->get();
    }

    public function getNoteById(int $id): Note
    {
        return Note::findOrFail($id)->load(['user', 'categories']);
    }

    public function createNote(StoreNoteRequest $request): Note
    {
        $note = new Note();

        $note->user_id      = $request->input('user_id');
        $note->title        = $request->input('title');
        $note->description  = $request->input('description');
        $note->created_at   = $request->input('created_at');
        $note->expired_at   = $request->input('expired_at', null);
        $note->image        = $request->input('image', null);

        $note->save();

        return $note;
    }

    public function updateNote(int $id, UpdateNoteRequest $request): Note
    {
        $note = Note::findOrFail($id);

        $note->title        = $request->input('title',          $note->title);
        $note->description  = $request->input('description',    $note->description);
        $note->created_at   = $request->input('created_at',     $note->created_at);
        $note->expired_at   = $request->input('expired_at',     $note->expired_at);
        $note->image        = $request->input('image',          $note->image);     

        $note->save();

        return $note;
    }

    public function deleteNote(int $id): void
    {
        $note = Note::findOrFail($id);

        $note->delete();
    }
}