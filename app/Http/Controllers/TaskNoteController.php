<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TaskNote;
use Validator;
use Auth;


class TaskNoteController extends Controller
{
    public function store(Request $request) {
        Validator::make($request->all(), [
            'task_id' => 'required',
            'note' => 'required',
        ])->validateWithBag('taskNote');
        
        $id = $request['task_id'];
        $user = Auth::user()->id;
        $request['user_id'] = $user;

        $input = $request->all();
        TaskNote::create($input);

        return redirect()->route('showTask', $id);
    }
}
