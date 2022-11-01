<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\User;
use App\Models\TaskUser;
use Auth;
use Validator;


class TaskController extends Controller
{
    public function store(Request $request) {
        Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
            'deadline' => 'required',
            'project_id' => 'required',
        ])->validateWithBag('projectTask');

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
        $authUser = Auth()->user()->id;
        $users = User::all();
        $taskUsers = TaskUser::where('task_id', $id)->get();

        return view('tasks/show', ['task' => $task,
                                   'authUser' => $authUser,
                                   'users' => $users,
                                   'taskUsers' => $taskUsers]);
    }

    public function complete(Request $request) {
        $id = $request['id'];
        $task = Task::findOrFail($id);
        $task->completed = "1";
        $task->update();

        return redirect()->route('showTask', $id);
    }
}
