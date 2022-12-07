<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;
use App\Models\Schedule;
use App\Models\ScheduleUser;
use App\Models\ScheduleNote;
use App\Models\UserDetail;
use App\Models\Employer;
use App\Models\User;

class ScheduleController extends Controller
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

    public function index() {
        return view ('field/schedule');  
    }

    public function jobs() {
        return view ('jobs/index');
    }

    public function create() {
        $employers = Employer::all();
        $userDetails = UserDetail::where('userType_id', '3')->get();
        return view ('jobs/create', ['employers' => $employers,
                                     'userDetails' => $userDetails]);
    }

    public function store(Request $request) {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'location' => 'required',
            'start' => 'required|date|after_or_equal:today',
            'finish' => 'required|date|after:start',
            'employer_id' => 'required',
            'user_id' => 'required',
        ]);

        $job = Schedule::create([
            'name' => $request['name'],
            'description' => $request['description'],
            'location' => $request['location'],
            'start' => $request['start'],
            'finish' => $request['finish'],
            'employer_id' => $request['employer_id'],
        ]);

        foreach ($request['user_id'] as $userID) {
            $assignedUsers = ScheduleUser::create([
                'schedule_id' => $job['id'],
                'user_id' => $userID,
            ]);
        }

        return redirect('/Jobs');
        
    }

    public static function calendar() {
        $date = empty($date) ? Carbon::now() : Carbon::createFromDate($date);
        $startOfCalendar = $date->copy()->startOfWeek(Carbon::MONDAY);
        $endOfCalendar = $date->copy()->endOfWeek(Carbon::SUNDAY);
        
        $user = Auth::user()->id;
        $userType = UserDetail::where('user_id', $user)->first();
        $jobs = Schedule::all();

        $html = '<div class="calendar">';
            
        while ($startOfCalendar <= $endOfCalendar) {
            $extraClass = $startOfCalendar->isToday() ? 'today' : '';

            $html .= '<div class="day '.$extraClass.'">';
            $html .= '<h2>' . $startOfCalendar->format('l jS F') . '</h2>';

            if ($userType['userType_id'] === 1 OR $userType['userType_id'] === 2) {            
                foreach ($jobs as $job) {
                    
                    if (date('d-m-Y', strtotime($job->start)) === $startOfCalendar->format('d-m-Y')) {
                        $html .= '<div class="job"> <div> 
                                    <h3>' . $job['name'] . '</h3>
                                    <p>' . $job['location'] . '</p>
                                    <p> Start Time: ' . date('g:i A', strtotime($job->start)) . '</p> </div>
                                    <a href="/Jobs/'.$job['id'].'"><button>More Details</button></a> 
                                    </div>';
                    }
                } 
            } elseif ($userType['userType_id'] === 3) {
                foreach ($jobs as $job) {
                    $jobSchedules = ScheduleUser::where('schedule_id', $job['id'])->get();
                    foreach ($jobSchedules as $jobSchedule) {
                        if ($jobSchedule['user_id'] === $user && date('d-m-Y', strtotime($job->start)) === $startOfCalendar->format('d-m-Y')) {
                            $html .= '<div class="job"> <div> 
                                      <h3>' . $job['name'] . '</h3>
                                      <p>' . $job['location'] . '</p>
                                      <p> Start Time: ' . date('g:i A', strtotime($job->start)) . '</p> </div>
                                      <a href="/Schedule/'.$job['id'].'"><button>More Details</button></a> 
                                      </div>';
                        }
                    }
                    
                }
            }
            $html .= '</div>';
            $startOfCalendar->addDay();
        }

        $html .= '</div>';
        echo $html;
    }

    public function show($id) {
        $job = Schedule::findOrFail($id);
        $jobUsers = ScheduleUser::where('schedule_id', $id)->get();
        $jobNotes = ScheduleNote::where('schedule_id', $id)->get()->sortBy('created_at');

        return view ('jobs/show', ['job' => $job,
                                   'jobUsers' => $jobUsers,
                                   'jobNotes' => $jobNotes]);
    }

    public function scheduleShow($id) {
        $job = Schedule::findOrFail($id);
        $jobUsers = ScheduleUser::where('schedule_id', $id)->get();
        $jobNotes = ScheduleNote::where('schedule_id', $id)->get()->sortBy('created_at');

        return view ('field/scheduleShow', ['job' => $job,
                                            'jobUsers' => $jobUsers,
                                            'jobNotes' => $jobNotes]);
    }
}
