<?php

namespace App\Console\Commands;

use App\Http\Requests\StoreNoteRequest;
use App\Services\NoteService;
use Illuminate\Console\Command;
use Illuminate\Http\Request;

class NoteCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'note:index';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(
        NoteService $noteService
    )
    {
        //$id     = $this->option('id');
        $action = 'index';

        switch($action) {
            case 'index' :$this->index($noteService) ;break;
            case 'show'  :$this->show($noteService) ;break;
            case 'create':$this->create($noteService) ;break;
            case 'update':$this->update($noteService) ;break;
            case 'delete':$this->delete($noteService) ;break;
        }
    }


    private function index(NoteService $noteService) {

        $request = new Request();

        $notes = $noteService->getNotes($request);

        $this->table(['ID', 'USER_ID', 'TITLE', 'DESCRIPTION', 'CREATED_AT', 'EXPIRED_AT', 'IMAGE'],
            $notes->map(function ($note) {
                return [
                    $note->id, 
                    $note->user_id, 
                    $note->title, 
                    $note->description, 
                    $note->created_at,
                    $note->expired_at,
                    $note->image
                ];
            })
        );
        
    }

    private function show(NoteService $noteService) {

    }

    private function create(NoteService $noteService) {

        $request = new StoreNoteRequest([
            'user_id'       => 3,
            'title'         => 'console title',
            'description'   => 'console description',
            'created_at'    => '2024-09-01',
            'expired_at'    => '2024-09-02',
            'image'         => 'http://localhost:8000/storage/images/66fc7f3168344_Screenshot_2024-09-23_23-32-23.png'
        ]);

        $note = $noteService->createNote($request);

        $this->info('note created sucessfull');
    }

    private function update(NoteService $noteService) {

        $request = new StoreNoteRequest([
            'user_id'       => 3,
            'title'         => 'console title',
            'description'   => 'console description',
            'created_at'    => '2024-09-01',
            'expired_at'    => '2024-09-02',
            'image'         => 'http://localhost:8000/storage/images/66fc7f3168344_Screenshot_2024-09-23_23-32-23.png'
        ]);

        $note = $noteService->createNote($request);

        $this->info('note created sucessfull');
    }

    private function delete(NoteService $noteService) {

        $request = new StoreNoteRequest([
            'user_id'       => 3,
            'title'         => 'console title',
            'description'   => 'console description',
            'created_at'    => '2024-09-01',
            'expired_at'    => '2024-09-02',
            'image'         => 'http://localhost:8000/storage/images/66fc7f3168344_Screenshot_2024-09-23_23-32-23.png'
        ]);

        $note = $noteService->createNote($request);

        $this->info('note created sucessfull');
    }
}
