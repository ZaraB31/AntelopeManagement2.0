<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserDetail;
use App\Models\Employer;
use App\Models\UserType;

class UserDetailController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function create() {
        $user = User::get()->sortByDesc('created_at')->first();
        $employers = Employer::all();
        $userTypes = UserType::all();

        return view('userDetails', ['user' => $user,
                                    'employers' => $employers,
                                    'userTypes' => $userTypes]);
    }

    public function store(Request $request) {
        $this->validate($request, [
            'user_id' => 'required',
            'employer_id' => 'required',
            'userType_id' => 'required',
        ]);

        $input = $request->all();
        UserDetail::create($input);

        return redirect('/');
    }
}
