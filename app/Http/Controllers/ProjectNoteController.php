<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProjectNote;
use Auth;
use Validator;


class ProjectNoteController extends Controller
{
    public function store(Request $request) {
        Validator::make($request->all(), [
            'project_id' => 'required',
            'note' => 'required',
        ])->validateWithBag('projectNote');
        
        $id = $request['project_id'];
        $user = Auth::user()->id;
        $request['user_id'] = $user;

        $input = $request->all();
        ProjectNote::create($input);

        return redirect()->route('showProject', $id);
    }
}
