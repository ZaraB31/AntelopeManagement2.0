<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Contact;

class ContactController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index() {
        $companies = Company::all();
        $contacts = Contact::all();

        return view('contactBook', ['companies' => $companies,
                                    'contacts' => $contacts]);
    }

    public function create($id) {
        $company = Company::findOrFail($id);

        return view('contacts/create', ['company' => $company]);
    }

    public function store(Request $request) {
        $this->validate($request, [
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required',
        ]);

        $input = $request->all();

        Contact::create($input);
        return redirect('/ContactBook');
    }

    public function edit($id) {
        $contact = Contact::findOrFail($id);

        return view('contacts/edit', ['contact' => $contact]);
    }

    public function update(Request $request, $id) {
        $this->validate($request, [
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required',
        ]);

        $contact = Contact::findOrFail($id);
        $contact->update($request->all());

        return redirect('/ContactBook');
    }

    public function delete(Request $request) {
        $id = $request['id'];

        $contact = Contact::findOrFail($id);
        $contact->delete();

        return redirect('/ContactBook');
    }
}
