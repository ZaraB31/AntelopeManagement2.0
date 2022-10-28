<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProjectNote;
use Auth;

class ProjectNoteController extends Controller
{
    public function store(Request $request) {
        $this->validate($request, [
            'project_id' => 'required',
            'note' => 'required',
        ]);
        $id = $request['project_id'];
        $user = Auth::user()->id;
        $request['user_id'] = $user;

        $input = $request->all();
        ProjectNote::create($input);

        return redirect()->route('showProject', $id);
    }
}
