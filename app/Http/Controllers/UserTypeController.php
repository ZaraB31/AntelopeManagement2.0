<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserType;

class UserTypeController extends Controller
{
    public function store(Request $request) {
        $this->validate($request, [
            'userType' => 'required|unique:user_types',
        ]);

        $input = $request->all();
        UserType::create($input);

        return redirect('/Admin');
    }
}
