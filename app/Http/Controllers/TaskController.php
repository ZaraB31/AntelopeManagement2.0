<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\User;
use App\Models\TaskUser;
use App\Models\TaskNote;
use App\Models\TaskImage;
use App\Models\TaskFile;
use Auth;
use Validator;
use File;


class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function store(Request $request) {
        Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
            'deadline' => 'required|date|after_or_equal:today',
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
        $taskImages = TaskImage::where('task_id', $id)->get()->sortBy('name');
        $taskFiles = TaskFile::where('task_id', $id)->get()->sortBy('name');
        $taskNotes = TaskNote::where('task_id', $id)->get()->sortByDesc('created_at');

        return view('tasks/show', ['task' => $task,
                                   'authUser' => $authUser,
                                   'users' => $users,
                                   'taskUsers' => $taskUsers,
                                   'taskNotes' => $taskNotes,
                                   'taskImages' => $taskImages,
                                   'taskFiles' => $taskFiles]);
    }

    public function complete(Request $request) {
        $id = $request['id'];
        $task = Task::findOrFail($id);
        $task->completed = "1";
        $task->update();

        return redirect()->route('showTask', $id);
    }

    public function edit($id) {
        $user = Auth()->user();
        $task = Task::findOrFail($id);

        return view('tasks/edit', ['task' => $task, 'user' => $user]);
    }

    public function update(Request $request, $id) {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'deadline' => 'required|date',
        ]);

        $task = Task::FindOrFail($id);

        $task->update($request->all());

        return redirect()->route('showTask', $id);
    } 

    public function delete(Request $request) {
        $id = $request['id'];
        $task = Task::findOrFail($id);
        $project = $task['project_id'];
        $taskImages = TaskImage::all();
        $taskDocs = TaskFile::all();

        foreach ($taskImages as $image) {
            if ($image['task_id'] == $id) {
                $filePath = 'uploads/images/';
                File::delete(public_path($filePath . $image['file']));
            }
        }
        foreach ($taskDocs as $doc) {
            if ($doc['task_id'] == $id) {
                $filePath = 'uploads/documents/';
                File::delete(public_path($filePath . $doc['file']));
            }
        }

        $task->delete();

        return redirect()->route('showProject', $project);
    }
}
