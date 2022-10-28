<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProjectContact;

class ProjectContactController extends Controller
{
    public function store(Request $request) {
        $this->validate($request, [
            'project_id' => 'required',
            'contact_id' => 'required',
        ]);
        $id = $request['project_id'];
        $input = $request->all();
        ProjectContact::create($input);

        return redirect()->route('showProject', $id);
    }
}
