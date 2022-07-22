<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Deduction;
use Illuminate\Support\Facades\Validator;
use App\Models\Employee;

class DeductionController extends Controller
{
    public function add(Request $request) {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'category_id' => 'required',
            'deduction' => 'required'
        ]);

        if($validator->fails()) {
            return response(['errors' => $validator->errors()], 401);
        }

        return response(['message' => 'Deduction added successfully']);
    }
}
