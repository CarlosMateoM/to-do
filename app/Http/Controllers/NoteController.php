<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNoteRequest;
use App\Http\Requests\UpdateNoteRequest;
use App\Http\Resources\NoteResource;
use App\Services\NoteService;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    public function __construct(
        private NoteService $noteService
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $notes = $this->noteService->getNotes($request);

        return NoteResource::collection($notes);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNoteRequest $request)
    {
        $note = $this->noteService->createNote($request);

        return new NoteResource($note);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $note = $this->noteService->getNoteById($id);

        return new NoteResource($note);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNoteRequest $request, int $id)
    {
        $note = $this->noteService->updateNote($id, $request);

        return new NoteResource($note);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $this->noteService->deleteNote($id);

        return response()->noContent();
    }
}
