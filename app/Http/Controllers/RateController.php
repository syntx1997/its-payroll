<?php

namespace App\Http\Controllers;

use App\Models\Deduction;
use App\Models\DeductionCategory;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Rate;
use App\Models\Employee;
use Illuminate\Support\Facades\Validator;

class RateController extends Controller
{
    public function get_all_employees() {
        $data = [];

        $employees = Employee::all();
        foreach ($employees as $employee) {
            if($employee->avatar == null) {
                $avatar_html = '<img src="'. asset('img/user.jpg') .'" style="width: 50px">';
            } else {
                $avatar_html = '<img src="'. asset('storage/'.$employee->avatar) .'" style="width: 50px">';
            }

            $user = User::where('id', $employee->user_id)->first();

            $attribute = <<<HERE
                data-id="$employee->id"
                data-employee_id="$employee->employee_id"
                data-employee_name="$employee->firstname $employee->lastname"
            HERE;


            $EmployeeRate = Rate::where('employee_id', $employee->id)->first();
            if($EmployeeRate) {
                $rateBtn = <<<HERE
                    <button id="set-rate-btn" type="button" $attribute data-rate="$EmployeeRate->rate" class="btn btn-link text-success">₱$EmployeeRate->rate</button>
                HERE;

            } else {
                $rateBtn = <<<HERE
                    <button id="set-rate-btn" type="button" $attribute data-rate="" class="btn btn-link text-danger">Not Set</button>
                HERE;
            }

            $data[] = [
                'id' => $employee->id,
                'user_id' => $employee->user_id,
                'employee_id' => $employee->employee_id,
                'firstname' => $employee->firstname,
                'middlename' => $employee->middlename,
                'lastname' => $employee->lastname,
                'name' => $employee->firstname .' ' . $employee->lastname,
                'gender' => $employee->gender,
                'contact' => $employee->contact,
                'email' => $user->email,
                'designation' => $employee->designation,
                'avatar_html' => $avatar_html,
                'rate' => $rateBtn
            ];
        }

        return response(['data' => $data], 201);
    }

    public function set(Request $request) {
        $validator = Validator::make($request->all(), [
            'employee_id' => 'required',
            'rate' => 'required'
        ]);

        if($validator->fails()) {
            return response(['errors' => $validator->errors()], 401);
        }

        $ifExists = Rate::where('employee_id', $request->employee_id)->first();

        if($ifExists) {
            $rate = Rate::find($ifExists->id);
            $rate->update(['rate' => $request->rate]);
        } else {
            Rate::create([
                'employee_id' => $request->employee_id,
                'rate' => $request->rate
            ]);
        }

        return response(['message' => 'Rate set successfully!'], 201);
    }
}
