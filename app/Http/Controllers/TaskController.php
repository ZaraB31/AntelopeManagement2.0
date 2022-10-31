<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Auth;

class TaskController extends Controller
{
    public function store(Request $request) {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'deadline' => 'required',
            'project_id' => 'required',
        ]);

        $user = Auth()->user()->id;
        $request['user_id'] = $user;
        $id = $request['project_id'];
        $request['completed'] = "0";
        $input = $request->all();

        Task::create($input);
        return redirect()->route('showProject', $id);
    }

    public function show($id) {
        $task = Task::findOrFail($id);

        return view('tasks/show', ['task' => $task]);
    }
}
