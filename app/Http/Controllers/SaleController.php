<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;
use Illuminate\Support\Facades\Validator;

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

        Sale::create($request->all());

        return response(['message' => 'Employee sale successfully added!'], 201);
    }
}
