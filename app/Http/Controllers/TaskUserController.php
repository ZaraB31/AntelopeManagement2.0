<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\TaskUser;

class TaskUserController extends Controller
{
    public function assignUser(Request $request) {
        Validator::make($request->all(), [
            'task_id' => 'required',
            'user_id' => 'required',
        ])->validateWithBag('assignUser');

        $id = $request['task_id'];
        $input = $request->all();

        TaskUser::create($input);

        return redirect()->route('showTask', $id);
    }
}
