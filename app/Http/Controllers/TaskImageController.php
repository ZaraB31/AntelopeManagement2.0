<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Validator;
use File;
use App\Models\TaskImage;

class TaskImageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function store(Request $request) {
        Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
            'file' => 'required|mimes:png,jpg,svg,jpeg',
        ])->validateWithBag('taskImage');

        $photo = $request->file('file');
        $photoName = date('Y-m-d').'-'.time().'.'.$photo->getClientOriginalExtension();
        $target_path = public_path('/uploads/images'); 

        $photo->move($target_path, $photoName);

        $user = Auth()->user()->id;
        $id = $request['task_id'];

        $upload = TaskImage::create(['name' => $request['name'], 
                                 'file' => $photoName,
                                 'description' => $request['description'],
                                 'user_id' => $user,
                                 'task_id' => $id]);

        return redirect()->route('showTask', $id);
    }

    public function download($id) {
        $image = TaskImage::findOrFail($id);
        $file = $image['file'];
        $filePath = public_path('/uploads/images/'.$file);

        return Response()->download($filePath);
    }

    public function update(Request $request) {
        $id = $request['id'];
        $image = TaskImage::findOrFail($id);

        Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
        ])->validateWithBag('updateTaskImage');

        $taskID = $request['task_id'];

        $image->update($request->all());
        
        return redirect()->route('showTask', $taskID);
    }

    public function delete(Request $request) {
        $id = $request['id'];
        $image = TaskImage::findOrFail($id);
        $task = $request['task_id'];

        $filePath = 'uploads/images/';
        File::delete(public_path($filePath . $image['file']));
        $image->delete();

        return redirect()->route('showTask', $task);
    }
}
