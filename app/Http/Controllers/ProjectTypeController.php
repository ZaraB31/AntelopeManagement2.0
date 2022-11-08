<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProjectType;

class ProjectTypeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function store(Request $request) {
        $this->validate($request, [
            'projectType' => 'required|unique:project_types',
        ]);

        $input = $request->all();
        ProjectType::create($input);

        return redirect('/Admin');
    }
}
