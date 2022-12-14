<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TaskFile;
use Auth;
use Validator;
use File;

class TaskFileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function store(Request $request) {
        Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
            'file' => 'required|mimes:doc,docx,pdf,xls,xlsx',
        ])->validateWithBag('taskFile');

        $document = $request->file('file');
        $documentName = date('Y-m-d').'-'.time().'.'.$document->getClientOriginalExtension();
        $target_path = public_path('/uploads/documents'); 

        $document->move($target_path, $documentName);

        $user = Auth()->user()->id;
        $id = $request['task_id'];

        $upload = TaskFile::create(['name' => $request['name'], 
                                 'file' => $documentName,
                                 'description' => $request['description'],
                                 'user_id' => $user,
                                 'task_id' => $id]);

        return redirect()->route('showTask', $id);
    }

    public function download($id) {
        $document = TaskFile::findOrFail($id);
        $file = $document['file'];
        $filePath = public_path('/uploads/documents/'.$file);

        return Response()->download($filePath);
    }

    public function update(Request $request) {
        $id = $request['id'];
        $file = TaskFile::findOrFail($id);

        Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
        ])->validateWithBag('updateTaskFile');

        $taskID = $request['task_id'];

        $file->update($request->all());
        
        return redirect()->route('showTask', $taskID);
    }

    public function delete(Request $request) {
        $id = $request['id'];
        $file = TaskFile::findOrFail($id);
        $task = $request['task_id'];

        $filePath = 'uploads/documents/';
        File::delete(public_path($filePath . $file['file']));
        $file->delete();

        return redirect()->route('showTask', $task);
    }
}
