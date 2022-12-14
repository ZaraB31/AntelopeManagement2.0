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
use App\Models\TaskImage;
use App\Models\TaskFile;
use Auth;
use Validator;
use File;
use Carbon\Carbon;


class ProjectController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
        $projects = Project::all();

        if ($projects->isNotEmpty()) {      
            foreach ($projects as $project) {
                $id = $project->id;
                $taskCount = Task::where('project_id', $id)->count();
                $completedTaskCount = Task::where('project_id', $id)->where('completed', 1)->count();
                if ($taskCount == 0) {
                    $percentage[$id] = 0;
                } else {
                    $percentage[$id] = ($completedTaskCount / $taskCount) * 100;
                }  
            }
        } else {
            $percentage = null;
        }

        if ($projects->isNotEmpty()) {
            foreach ($projects as $project) {
                
                $id = $project->id;
                $today = Carbon::now();
                $projectTimeLeft[$id] = strtotime($project->deadline) - strtotime($today);
                $projectTimeLeft[$id] = $projectTimeLeft[$id] / 86400;
                $projectTimeLeft[$id] = round($projectTimeLeft[$id]);
                if ($projectTimeLeft[$id] == 0) {
                    $projectTimeLeft[$id] = 'Today';
                } else if ($projectTimeLeft[$id] < 0) {
                    $projectTimeLeft[$id] = 'Overdue';
                }
            }
        } else {
            $projectTimeLeft = null;
        }
        
        return view ('projects/dashboard', ['projects' => $projects,
                                            'percentage' => $percentage,
                                            'projectTimeLeft' => $projectTimeLeft]);
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

    public function edit($id) {
        $project = Project::findOrFail($id);
        $projectTypes = ProjectType::all()->sortBy('projectType');
        $companies = Company::all()->sortBy('company');
        $employers = Employer::all()->sortBy('employer');
        $user = Auth()->user();

        return view('projects/edit', ['project' => $project,
                                      'projectTypes' => $projectTypes,
                                      'companies' => $companies,
                                      'employers' => $employers,
                                      'user' => $user]);
    }

    public function update(Request $request, $id) {
        $this->validate($request, [
            'name' => 'required',
            'deadline' => 'required|date',
            'projectType_id' => 'required',
            'company_id' => 'required',
            'employer_id' => 'required',
            'description' => 'required',
        ]);

        $project = Project::FindOrFail($id);

        $project->update($request->all());

        return redirect()->route('showProject', $id);
    } 

    public function delete(Request $request) {
        $id = $request['id'];
        $project = Project::findOrFail($id);
        $tasks = Task::all();
        $taskImages = TaskImage::all();
        $taskFiles = TaskFile::all();

        foreach($tasks as $task) {
            if ($task['project_id'] == $id) {
                foreach ($taskImages as $image) {
                    if ($image['task_id'] == $task['id']) {
                        $filePath = 'uploads/images/';
                        File::delete(public_path($filePath . $image['file']));
                    }
                }
                foreach ($taskFiles as $doc) {
                    if ($doc['task_id'] == $task['id']) {
                        $filePath = 'uploads/documents/';
                        File::delete(public_path($filePath . $doc['file']));
                    }
                }
            }
        }

        $project->delete();
        return redirect('/ProjectsDashboard');
    }
}
