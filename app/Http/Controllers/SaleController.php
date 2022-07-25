<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;
use Illuminate\Support\Facades\Validator;
use App\Models\Employee;

class SaleController extends Controller
{
    public function add(Request $request) {
        $validator = Validator::make($request->all(), [
            'quantity' => 'required',
            'employee_id' => 'required'
        ]);

        if($validator->fails()) {
            return response(['errors' => $validator->errors()], 401);
        }

        Sale::create([
            'employee_id' => $request->employee_id,
            'quantity' => $request->quantity
        ]);

        return response(['message' => 'Employee sale successfully added!'], 201);
    }

    public function get_all() {
        $data = [];

        foreach (Sale::all() as $sale) {
            $employee = Employee::where('id', $sale->employee_id)->first();
            $data[] = [
                'e_id' => $sale->id,
                'title' => $employee->firstname . ' ' . substr($employee->lastname, 0 , 1) . ' - ' . $sale->quantity,
                'start' => $sale->created_at,
                'end' => $sale->created_at,
                'className' => 'primary'
            ];
        }

        return response($data, 201);
    }
}
