<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\ProjectType;
use App\Models\Company;
use App\Models\Employer;

class ProjectController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
        $projects = Project::all();
        return view ('projects/dashboard', ['projects' => $projects]);
    }

    public function create() {
        $projectTypes = ProjectType::all();
        $companies = Company::all();
        $employers = Employer::all();

        return view('projects/create', ['projectTypes' => $projectTypes,
                                        'companies' => $companies,
                                        'employers' => $employers]);
    }

    public function store(Request $request) {
        $this->validate($request, [
            'name' => 'required',
            'deadline' => 'required|date|after_or_equal:today',
            'projectType_id' => 'required',
            'company_id' => 'required',
            'employer_id' => 'required',
            'description' => 'required',
        ]);

        $input = $request->all();
        Project::create($input);

        return redirect('/ProjectsDashboard');
    }
}
