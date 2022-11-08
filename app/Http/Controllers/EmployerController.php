<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employer;
use Validator;

class EmployerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function store(Request $request) {

        Validator::make($request->all(), [
            'employer' => 'required|unique:employers',
        ])->validateWithBag('employers');

        $input = $request->all();
        Employer::create($input);

        return redirect('/Admin');
    }

    public function update(Request $request) {
        $id = $request['id'];

        Validator::make($request->all(), [
            'employer' => 'required|unique:employers',
        ])->validateWithBag('updateEmployers');

        $employer = Employer::findOrFail($id);

        $employer->update($request->all());
        return redirect('/Admin');
    }
}
