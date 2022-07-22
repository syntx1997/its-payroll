<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Deduction;
use Illuminate\Support\Facades\Validator;
use App\Models\Employee;
use App\Models\DeductionCategory;

class DeductionController extends Controller
{
    public function set(Request $request) {
        $validator = Validator::make($request->all(), [
            'deduction' => 'required',
            'category_id' => 'required',
            'user_id' => 'required'
        ]);

        $ifExists = Deduction::where([
            'category_id' => $request->category_id,
            'user_id' => $request->user_id
        ])->first();

        if($ifExists) {
            $deduction = Deduction::find($ifExists->id);
            $deduction->update(['deduction' => $request->deduction]);
        } else {
            Deduction::create([
                'user_id' => $request->user_id,
                'category_id' => $request->category_id,
                'deduction' => $request->deduction,
            ]);
        }

        if($validator->fails()){
            return response(['errors' => $validator->errors()], 401);
        }

        return response(['message' => 'Deduction set successfully']);
    }

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
            $deductions = [];

            $deductionCategories = DeductionCategory::all();
            foreach ($deductionCategories as $deductionCategory) {

                $employeeDeduction = Deduction::where([
                    'user_id' => $employee->id,
                    'category_id' => $deductionCategory->id
                ])->first();

                $deductions[] = [
                    'id' => $deductionCategory->id,
                    'name' => $deductionCategory->name,
                    'deduction' => $employeeDeduction->deduction ?? 'Not Set'
                ];
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
                'deductions' => $deductions
            ];
        }

        return response(['data' => $data], 201);
    }
}
