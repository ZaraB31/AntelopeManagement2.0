<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserType;
use Validator;

class UserTypeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function store(Request $request) {
        Validator::make($request->all(), [
            'userType' => 'required|unique:user_types',
        ])->validateWithBag('userTypes');

        $input = $request->all();
        UserType::create($input);

        return redirect('/Admin');
    }

    public function update(Request $request) {
        $id = $request['id'];

        Validator::make($request->all(), [
            'userType' => 'required|unique:user_types',
        ])->validateWithBag('updateUserTypes');

        $userType = UserType::findOrFail($id);

        $userType->update($request->all());
        return redirect('/Admin');
    }
}
