<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProjectContact;
use Validator;


class ProjectContactController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function store(Request $request) {
        Validator::make($request->all(), [
            'project_id' => 'required',
            'contact_id' => 'required',
        ])->validateWithBag('linkContact');
        
        $id = $request['project_id'];
        $input = $request->all();
        ProjectContact::create($input);

        return redirect()->route('showProject', $id);
    }
}
