<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserType;
use App\Models\Employer;
use App\Models\ProjectType;
use App\Models\User;
use App\Models\UserDetail;
use App\Models\Project;
use App\Models\Task;
use App\Models\TaskUser;
use Auth;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $userID = Auth()->user()->id;
        $user = Auth()->user();
        $userTasks = TaskUser::where('user_id', $userID)->get();
        $userProjects = Project::where('user_id', $userID)->get()->sortBy('deadline');

        if ($userTasks->isNotEmpty()){
            foreach ($userTasks as $userTask) {
                $id = $userTask->id;
                $today = Carbon::now();
                $taskTimeLeft[$id] = strtotime($userTask->task->deadline) - strtotime($today);
                $taskTimeLeft[$id] = $taskTimeLeft[$id] / 86400;
                $taskTimeLeft[$id] = round($taskTimeLeft[$id]);
                if ($taskTimeLeft[$id] == 0) {
                    $taskTimeLeft[$id] = 'Today';
                } else if ($taskTimeLeft[$id] < 0) {
                    $taskTimeLeft[$id] = 'Overdue';
                }
            }
        } else {
            $taskTimeLeft = null;
        }

        if ($userProjects->isNotEmpty()) {
            foreach ($userProjects as $userProject) {
                
                $id = $userProject->id;
                $today = Carbon::now();
                $projectTimeLeft[$id] = strtotime($userProject->deadline) - strtotime($today);
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

        return view('home', ['userTasks' => $userTasks,
                             'taskTimeLeft' => $taskTimeLeft,
                             'user' => $user,
                             'userProjects' => $userProjects,
                             'projectTimeLeft' => $projectTimeLeft]);
    }

    public function admin() {
        $userTypes = UserType::all();
        $employers = Employer::all()->sortBy('employer');
        $projectTypes = ProjectType::all()->sortBy('projectType');
        $currentUser = Auth::id();
        $accessLevel = UserDetail::where('user_id', $currentUser)->first();
        $userDetails = UserDetail::all();
        $users = User::all();

        return view('admin', ['userTypes' => $userTypes,
                              'employers' => $employers,
                              'projectTypes' => $projectTypes,
                              'currentUser' => $currentUser,
                              'accessLevel' => $accessLevel,
                              'userDetails' => $userDetails,
                              'users' => $users]);
    }

    public function editUser($id) {
        $user = User::findOrFail($id);
        $employers = Employer::all();
        $userTypes = UserType::all();
        $userDetail = UserDetail::where('user_id', $id)->first();

        return view('editUser', ['user' => $user,
                                 'employers' => $employers,
                                 'userTypes' => $userTypes,
                                 'userDetail' => $userDetail]);
    }

    public function updateUser(Request $request) {
        $id = $request['id'];
        $user = User::findOrFail($id);
        $detail = UserDetail::where('user_id', $id)->first();

        $user->update(['name' => $request['name'],
                       'email' => $request['email']]);
        $detail->update(['employer_id' => $request['employer_id'],
                         'userType_id' => $request['userType_id']]);

        return redirect('/Admin');
    }
}
