<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ScheduleNote;
use Auth;

class ScheduleNoteController extends Controller
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

    public function scheduleStore(Request $request) {
        $this->validate($request, [
            'schedule_id' => 'required',
            'note' => 'required',
        ]);

        $user = Auth::User()->id;
        $request['user_id'] = $user;
        
        $id = $request['schedule_id'];

        $input = $request->all();

        ScheduleNote::create($input);
        return redirect()->route('fieldShow', $id);
    }

    public function store(Request $request) {
        $this->validate($request, [
            'schedule_id' => 'required',
            'note' => 'required',
        ]);

        $user = Auth::User()->id;
        $request['user_id'] = $user;
        
        $id = $request['schedule_id'];

        $input = $request->all();

        ScheduleNote::create($input);
        return redirect()->route('jobShow', $id);
    }
}
