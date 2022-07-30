<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class EmployeeSettingController extends Controller
{
    public function update_password(Request $request) {
        $validator = Validator::make($request->all(), [
            'current_password' => 'required',
            'new_password' => 'required',
            'confirm_password' => 'required',
        ]);

        if($validator->fails()) {
            return response(['errors' => $validator->errors()], 401);
        }

        // Get user
        $user = User::find($request->id);

        // If Password Is Incorrect
        if(!$user || !Hash::check($request->current_password, $user->password)) {
            return response(['error' => 'Password you\'ve entered is incorrect!'], 401);
        }

        // If Passwords Dot Not Matched
        if($request->new_password != $request->confirm_password) {
            return response(['error' => 'Passwords do not matched!'], 401);
        }

        $user->update(['password' => bcrypt($request->new_password)]);

        return response(['message' => 'Password has been updated!']);
    }

    public function update_info(Request $request) {
        $validator = Validator::make($request->all(), [
            'firstname' => 'required',
            'middlename' => 'required',
            'lastname' => 'required',
            'address' => 'required',
            'contact' => 'required',
            'id' => 'required'
        ]);

        if($validator->fails()) {
            return response(['errors' => $validator->errors()], 401);
        }

        $employee = Employee::find($request->id);
        $employee->update($request->all());

        return response(['message' => 'Information has been updated!']);
    }
}
