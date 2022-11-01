<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Validator;
use App\Models\TaskImage;

class TaskImageController extends Controller
{
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
}
