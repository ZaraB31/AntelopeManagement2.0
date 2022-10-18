<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserType;

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
        return view('admin', ['userTypes' => $userTypes]);
    }
}
