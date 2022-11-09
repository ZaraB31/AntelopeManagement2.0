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

    public function Update(Request $request) {
        $id = $request['id'];
        $company = Company::findOrFail($id);
        $company->update($request->all());

        return redirect('/ContactBook');
    }

    public function delete(Request $request) {
        $id = $request['id'];

        $company = Company::findOrFail($id);
        $company->delete();

        return redirect('/ContactBook');
    }
}
