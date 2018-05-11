<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Note;

class NotesController extends Controller
{
    /**
     * Display a listing of Note.
     *
     * @return note list
     */
    public function index(Request $request){

        $status = 1;

        $data = Note::all();

        return compact('status', 'data');
    }

    /**
     * Creating new Note.
     *
     * @return note id
     */
    public function create(Request $request){

        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
        ]);

        $status = 1;

        if ($validator->fails()) {

            $status = 0;

            $error = $validator->messages();

            return compact('status', 'error');
        }

        $note = Note::create($request->all());

        $data = $note->id;

        return compact('status', 'data');
    }

    /**
     * Update Note in storage.
     *
     * @return note id
     */
    public function update(Request $request){

        $validator = Validator::make($request->all(), [
            'note_id' => ['required', 'exists:notes,id'],
            'title' => 'required',
            'description' => 'required',
        ]);
        $status = 1;

        if ($validator->fails()) {

            $status = 0;

            $error = $validator->messages();

            return compact('status', 'error');
        }

        $note = Note::where('id',$request->note_id)->first();

        $note->update($request->all());

        $note->save();

        $data = $note->id;

        return compact('status', 'data');
    }
}
