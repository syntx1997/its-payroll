<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Rate;

class EmployeeController extends Controller
{
    public function add(Request $request) {
        $validator = Validator::make($request->all(), [
            'firstname' => 'required',
            'middlename' => 'required',
            'lastname' => 'required',
            'gender' => 'required',
            'birthday' => 'required',
            'address' => 'required',
            'designation' => 'required',
            'department' => 'required',
            'email' => 'required',
            'contact' => 'required',
            'password' => 'required'
        ]);

        if($validator->fails()) {
            return response(['errors' => $validator->errors()], 401);
        }

        if($request->has('avatar')) {
            $avatar = $request->file('avatar')->store('avatar', 'public');
        } else {
            $avatar = null;
        }

        // Create User Account
        $user = User::create([
            'name' => $request->firstname . ' ' . $request->lastname,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'type' => 'Employee'
        ]);


        Employee::create([
            'user_id' => $user->id,
            'employee_id' => $this->generateEmployeeId(),
            'firstname' => $request->firstname,
            'middlename' => $request->middlename,
            'lastname' => $request->lastname,
            'gender' => $request->gender,
            'birthday' => $request->birthday,
            'address' => $request->address,
            'contact' => $request->contact,
            'designation' => $request->designation,
            'department' => $request->department,
            'avatar' => $avatar
        ]);

        return response(['message' => 'Employee Added Successfully!']);
    }

    private function generateEmployeeId() {
        return 'IND' . date('Y') . (count(User::all()) + 1);
    }

    public function get_all() {
        $data = [];
        $employees = Employee::all()->sortByDesc('id');

        foreach ($employees as $employee) {

            $user = User::where('id', $employee->user_id)->first();

            if($employee->avatar == null) {
                $avatar_html = '<img src="'. asset('img/user.jpg') .'" style="width: 50px">';
            } else {
                $avatar_html = '<img src="'. asset('storage/'.$employee->avatar) .'" style="width: 50px">';
            }

            $attributes = <<<HERE
                data-id="$employee->id"
                data-user_id="$employee->user_id"
                data-employee_id="$employee->employee_id"
                data-firstname="$employee->firstname"
                data-middlename="$employee->middlename"
                data-lastname="$employee->lastname"
                data-gender="$employee->gender"
                data-birthday="$employee->birthday",
                data-address="$employee->address"
                data-contact="$employee->contact"
                data-designation="$employee->designation"
                data-department="$employee->department"
                data-avatar="$employee->avatar"
                data-email="$user->email"
            HERE;


            $actions = <<<HERE
                <button id="edit-btn" type="button" class="btn btn-light" $attributes><i class="la la-pen font-weight-bold text-dark"></i></button>
            HERE;


            $data[] = [
                'id' => $employee->id,
                'user_id' => $employee->user_id,
                'employee_id' => $employee->employee_id,
                'firstname' => $employee->firstname,
                'middlename' => $employee->middlename,
                'lastname' => $employee->lastname,
                'name' => $employee->firstname . ' ' . $employee->lastname,
                'gender' => $employee->gender,
                'birthday' => $employee->birthday,
                'address' => $employee->address,
                'contact' => $employee->contact,
                'designation' => $employee->designation,
                'department' => $employee->department,
                'avatar' => $employee->avatar,
                'email' => $user->email,
                'avatar_html' => $avatar_html,
                'actions' => $actions
            ];
        }

        return response(['data' => $data], 201);
    }

    public function edit(Request $request) {
        $validator = Validator::make($request->all(), [
            'firstname' => 'required',
            'middlename' => 'required',
            'lastname' => 'required',
            'gender' => 'required',
            'birthday' => 'required',
            'address' => 'required',
            'designation' => 'required',
            'department' => 'required',
            'email' => 'required',
            'contact' => 'required',
            'id' => 'required'
        ]);

        if($validator->fails()) {
            return response(['errors' => $validator->errors()], 401);
        }

        $fields = [
            'firstname' => $request->firstname,
            'middlename' => $request->middlename,
            'lastname' => $request->lastname,
            'gender' => $request->gender,
            'birthday' => $request->birthday,
            'address' => $request->address,
            'designation' => $request->designation,
            'department' => $request->department,
            'email' => $request->email,
            'contact' => $request->contact,
            'id' => $request->id
        ];

        if($request->has('avatar')) {
            $fields['avatar'] = $request->file('avatar')->store('avatar', 'public');
        }

        $employee = Employee::find($fields['id']);
        $employee->update($fields);

        return response(['message' => 'Employee Updated Successfully!']);
    }

    public function get_employee(Request $request) {
        $empl = Employee::where('id', $request->id)->first();
        $salary = Rate::where('employee_id', $empl->id)->first();
        $employee = [
            'name' => $empl->firstname . ' ' . $empl->lastname,
            'employee_id' => $empl->employee_id,
            'designation' => $empl->designation,
            'department' => $empl->department,
            'basic_salary' => $salary->rate ?? 00.00
        ];

        return response(['employee' => $employee]);
    }
}
