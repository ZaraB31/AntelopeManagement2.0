<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employer;

class EmployerController extends Controller
{
    public function store(Request $request) {

        $this->validate($request, [
            'employer' => 'required|unique:employers',
        ]);

        $input = $request->all();
        Employer::create($input);

        return redirect('/Admin');
    }
}
