<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;

class CompanyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request) {
        $this->validate($request, [
            'company' => 'required',
        ]);

        $input = $request->all();
        Company::create($input);

        return redirect('ContactBook');

    }
}
