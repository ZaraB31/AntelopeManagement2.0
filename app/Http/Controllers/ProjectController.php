<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\ProjectType;
use App\Models\Company;
use App\Models\Contact;
use App\Models\Employer;
use App\Models\ProjectContact;
use App\Models\ProjectNote;
use App\Models\Task;
use Auth;
use Validator;


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

        $user = Auth()->user()->id;
        $request['user_id'] = $user;
        $input = $request->all();
        Project::create($input);

        return redirect('/ProjectsDashboard');
    }

    public function show($id) {
        $project = Project::findOrFail($id);
        $companies = Company::all();
        $contacts = Contact::all();
        $projectContacts = ProjectContact::where('project_id', $id)->get();
        $projectNotes = ProjectNote::where('project_id', $id)->get()->sortByDesc('created_at');
        $projectTasks = Task::where('project_id', $id)->get()->sortByDesc('deadline');
        $authUser = Auth()->user()->id;

        return view('projects/show', ['project' => $project,
                                      'companies' => $companies,
                                      'contacts' => $contacts,
                                      'projectContacts' => $projectContacts,
                                      'projectNotes' => $projectNotes,
                                      'projectTasks' => $projectTasks,
                                      'authUser' => $authUser]);
    }

    public function complete(Request $request) {
        $id = $request['id'];
        $project = Project::findOrFail($id);
        $project->completed = "1";
        $project->update();

        return redirect()->route('showProject', $id);
    }
}
