<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProjectType;
use Validator;

class ProjectTypeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function store(Request $request) {
        Validator::make($request->all(), [
            'projectType' => 'required|unique:project_types',
        ])->validateWithBag('projectTypes');

        $input = $request->all();
        ProjectType::create($input);

        return redirect('/Admin');
    }

    public function update(Request $request) {
        $id = $request['id'];

        Validator::make($request->all(), [
            'projectType' => 'required|unique:project_types',
        ])->validateWithBag('updateProjectTypes');

        $projectType = ProjectType::findOrFail($id);

        $projectType->update($request->all());
        return redirect('/Admin');
    }
}
