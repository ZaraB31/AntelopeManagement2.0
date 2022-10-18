<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserType;
use App\Models\Employer;
use App\Models\ProjectType;

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
        return view('home');
    }

    public function admin() {
        $userTypes = UserType::all();
        $employers = Employer::all()->sortBy('employer');
        $projectTypes = ProjectType::all()->sortBy('projectType');

        return view('admin', ['userTypes' => $userTypes,
                              'employers' => $employers,
                              'projectTypes' => $projectTypes]);
    }
}
